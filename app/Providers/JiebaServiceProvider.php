<?php

namespace App\Providers;

use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\JiebaAnalyse;
use Fukuball\Jieba\Posseg;
use Illuminate\Support\ServiceProvider;

class JiebaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        ini_set('memory_limit', '1024M');
        //结巴分词
        $jieba = new Jieba();
        $jieba::init(array('dict'=>env('DICT_TYPE', 'normal'))); // 词典类型，小词典占用内存更小，可选择使用。 https://github.com/fukuball/jieba-php#%E5%85%B6%E4%BB%96%E8%A9%9E%E5%85%B8

        $jiebaAnalyse = new JiebaAnalyse();
        $jiebaAnalyse::init(array('dict'=>env('DICT_TYPE', 'normal')));

        $jiebaPosseg = new Posseg();
        $jiebaPosseg::init();

        // laravels singleton还是会实例化新对象，需要使用instance指定静态了常驻内存
        $this->app->instance('Jieba', $jieba);
        $this->app->instance('JiebaAnalyse', $jiebaAnalyse);
        $this->app->instance('JiebaPosseg', $jiebaPosseg);
        Finalseg::init();
    }
}
