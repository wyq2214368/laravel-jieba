## Just a simple server！

结巴分词是一款优秀的中文分词库，之前在python应用中有使用，目前在php业务中需要接入，但对于php而言，fpm的形式导致每次请求的词典加载耗时过长，因此提供基于laravels的分词服务，方便快速部署简单场景下的分词服务。
<p align="left">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://github.com/wyq2214368/laravel-jieba/blob/master/LICENSE"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 要求

| 依赖 | 说明 |
| -------- | -------- |
| [PHP](https://secure.php.net/manual/zh/install.php) | `>= 7.2.0` |
| [Swoole扩展](https://www.swoole.com/) | `>= 4.x` `推荐4.2.3+` |

## 功能示例（demo）
>请自行修改get请求的content参数内容

1. 中文分词

    [http://analyse.buling.club/api/cut?content=我爱北京天安门](http://analyse.buling.club/api/cut?content=%E6%88%91%E7%88%B1%E5%8C%97%E4%BA%AC%E5%A4%A9%E5%AE%89%E9%97%A8)

2. 关键词提取
    
    [http://analyse.buling.club/api/analyse?content=我爱北京天安门](http://analyse.buling.club/api/analyse?content=%E6%88%91%E7%88%B1%E5%8C%97%E4%BA%AC%E5%A4%A9%E5%AE%89%E9%97%A8)

3. 分词位置标注

    [http://analyse.buling.club/api/tokenize?content=我爱北京天安门](http://analyse.buling.club/api/tokenize?content=%E6%88%91%E7%88%B1%E5%8C%97%E4%BA%AC%E5%A4%A9%E5%AE%89%E9%97%A8)

4. 分词词性标注

    [http://analyse.buling.club/api/posseg?content=我爱北京天安门](http://analyse.buling.club/api/posseg?content=%E6%88%91%E7%88%B1%E5%8C%97%E4%BA%AC%E5%A4%A9%E5%AE%89%E9%97%A8)


## 安装
*请先确保 [swoole](https://wiki.swoole.com/wiki/page/6.html)、[composer](https://docs.phpcomposer.com/00-intro.html) 已安装。如未安装可根据链接中的官方文档进行安装*
1. 克隆代码
    ```
    git clone https://github.com/wyq2214368/laravel-jieba.git
    ```

2. composer安装依赖
    ```
    composer install
    ```
    
   >以下的步骤是laravel及laravels的相关配置，您可以选择使用 `php artisan install` 指令一键完成。或根据相应文档完成设置
3. 创建.env文件
    ```
    cp .env.example .env
    ```
    
4. 生成laravel的key
    ```
    php artisan key:generate
    ```

5. 文件夹权限设置
    ```
    chmod -R 777 storage/
    chmod -R 777 bootstrap/cache/
    ```
    >可视情况合理分配需要的权限
    
    或分配php-fpm进程用户为所有者
    ```bash
    choown -R apache:apache
    ```
    
6. 启动服务
    ```
    php artisan serve
    ```
    > 如果您不想启动laravel server而是使用laravel是服务，可以通过 `php artisan install` 指令启动laravels服务，或通过[laravels文档](https://github.com/hhxsv5/laravel-s/blob/master/README-CN.md#%E7%89%B9%E6%80%A7)自行启动
    
4. 访问并测试服务
   
   服务启动后可通过 [http://127.0.0.1:8000/api/cut?content=吃葡萄不吐葡萄皮]( http://127.0.0.1:8000/api/cut?content=%E5%90%83%E8%91%A1%E8%90%84%E4%B8%8D%E5%90%90%E8%91%A1%E8%90%84%E7%9A%AE)
    > 如您启动的laravels服务，则需要使用laravels配置的端口(默认是 5200)
    



## License

[MIT](https://github.com/wyq2214368/laravel-jieba/blob/master/LICENSE)

## 感谢

   欢迎star～
