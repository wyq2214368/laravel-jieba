<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Fukuball\Jieba\Finalseg;
use Illuminate\Http\Request;

class JiebaController extends Controller
{
    public $jieba;
    public $jiebaAnalyse;
    public $jiebaPosseg;

    /**
     * JiebaController constructor.
     */
    public function __construct()
    {
        $this->jieba = app('Jieba');
        $this->jiebaAnalyse = app('JiebaAnalyse');
        $this->jiebaPosseg = app('JiebaPosseg');
    }

    /**
     * 分词
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function cut(Request $request) : array
    {
        $this->validate($request, [
            'content' => 'required|string'
        ]);
        $content = $request->input('content');
        $result = $this->jieba::cut($content);
        return $result;
    }

    /**
     * 关键词提取
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function analyse(Request $request) : array
    {
        $this->validate($request, [
            'content' => 'required|string',
            'num' => 'int',
            'type' => 'array'
        ]);

        $content = $request->input('content');
        $num = $request->input('num', 10);
        $type = $request->input('type', ['n']);

        $result = $this->jiebaAnalyse::extractTags($content, $num, $type);

        return $result;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function tokenize(Request $request) : array
    {
        $this->validate($request, [
            'content' => 'required|string'
        ]);

        $content = $request->input('content');

        $result = $this->jieba::tokenize($content);
        return $result;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function posseg(Request $request) : array
    {
        $this->validate($request, [
            'content' => 'required|string'
        ]);

        $content = $request->input('content');

        $result = $this->jiebaPosseg::cut($content);
        return $result;
    }
}
