<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($action)
    {
        return $this->$action();
    }

    public function jieba()
    {
        $t1 = time();
        $jieba = app('Jieba');
        $t2 = time();

        $result = $jieba->cut('我爱北京天安门');
        $result[] = $t2 - $t1;
        return $result;
    }
}
