<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkInstall();

        $steps = [
            'composerInstall', //composer安装依赖
            'laravelsPublish', //laravels配置文件发布
            'startServer' //启动服务
        ];
        $bar = $this->output->createProgressBar(count($steps));
        $bar->start();

        foreach ($steps as $step) {
            $this->line('');
            $this->$step();
            $bar->advance();
        }

        Cache::forever('command-install-flag', date('Y-m-d H:i:s'));
        $this->line(PHP_EOL);
        $this->info('完成');
    }


    protected function composerInstall()
    {
        $this->info('安装composer依赖项');
        $this->line(shell_exec('composer install'));
    }

    protected function laravelsPublish()
    {
        $this->info('发布laravels配置文件');
        $this->line(shell_exec('php artisan laravels publish -n'));
    }

    protected function startServer()
    {
        $this->info('启动laravels');
        $this->line(shell_exec('php bin/laravels start -d'));
        $config = config('laravels');
        $ip = $config['listen_ip'];
        $port = $config['listen_port'];
        $this->info("laravels已启动，访问 http://{$ip}:{$port}");

        $testText = '吃葡萄不吐葡萄皮';
        $this->line("测试语句：{$testText}");
        $this->line("测试链接: http://{$ip}:{$port}/api/cut?content=".urlencode($testText));
        $this->info("如需停止laravels服务，可使用 php bin/laravels stop 指令");
    }

    protected function checkInstall()
    {
        if (Cache::has('command-install-flag')) {
            if ($this->confirm('您已安装过，是否重新安装?')) {
                $this->line('开始安装...');
            } else {
                $this->info('已取消');
                die;
            }
        }
    }
}
