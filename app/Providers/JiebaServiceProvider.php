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
        $this->app->singleton('Jieba', function () {
            $jieba = new Jieba();
            $jieba::init();
            return $jieba;
        });
        $this->app->singleton('JiebaAnalyse', function () {
            $jiebaAnalyse = new JiebaAnalyse();
            $jiebaAnalyse::init();
            return $jiebaAnalyse;
        });
        $this->app->singleton('JiebaPosseg', function () {
            $jiebaPosseg = new Posseg();
            $jiebaPosseg::init();
            return $jiebaPosseg;
        });
        Finalseg::init();
    }
}
