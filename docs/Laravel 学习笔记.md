# 学习Laravel笔记


[TOC]

<br>
>本笔记是通过学习[《Laravel入门教程》](https://laravel-china.org/courses/laravel-essential-training-5.5/543/about-the-book)形成的笔记，感兴趣的同学可以去买一本。本文内容也大多出自[这个网站](https://laravel-china.org)。

<br>
>这些网站可以用作资源查询网站:
https://laravel-china.org   中文，通过实际的搭建微博、BBS网站来系统学习Laravel。
http://laravelacademy.org   中文，官方文档翻译。
https://getbootstrap.com

## 在开始之前我们需要弄懂几个工具：

### 1. Composer

Composer 是 PHP 的一个依赖管理工具。它允许你申明项目所依赖的代码库，它会在你的项目中为你安装他们.
    Composer 不是一个包管理器。是的，它涉及 "packages" 和 "libraries"，但它在每个项目的基础上进行管理，在你项目的某个目录中（例如 `vendor`）进行安装。默认情况下它不会在全局安装任何东西。因此，这仅仅是一个依赖管理。
    他会根据你目录中的`composer.json`来判断你有那些dependencies。

这是一个列子：
    
    "name": "laravel/laravel",
        "description": "The Laravel Framework.",
        "keywords": ["framework", "laravel"],
        "license": "MIT",
        "type": "project",
        "require": {
            "php": "^7.1.3",
            "fideloper/proxy": "^4.0",
            "laravel/framework": "5.6.*",
            "laravel/tinker": "^1.0"
        },
        "require-dev": {
            "filp/whoops": "^2.0",
            "fzaninotto/faker": "^1.4",
            "mockery/mockery": "^1.0",
            "nunomaduro/collision": "^2.0",
            "phpunit/phpunit": "^7.0"
        },
        "autoload": {
            "classmap": [
                "database/seeds",
                "database/factories"
            ],
            "psr-4": {
                "App\\": "app/"
            }
        },
        "autoload-dev": {
            "psr-4": {
                "Tests\\": "tests/"
            }
        },
        "extra": {
            "laravel": {
                "dont-discover": [
                ]
            }
        },
        
### 2. Homebrew

Homebrew 是用来安装MAC OS上没有预装但是在开发或者其他过程中需要用到的东西。Homebrew 会将软件包安装到独立目录，并将其文件软链接至 `/usr/local `。

Homebrew 不会将文件安装到它本身目录之外，所以您可将 Homebrew 安装到任意位置。即所有软件包都会安装至homebrew目录下，默认安装至`usr/local/Cellar`下。

### 3. git
git是一个软件版本控制工具，通过git，我们可以更方便的建立分支并在分支上进行多次开发等功能。

### 4. npm
npm 为你和你的团队打开了连接整个 JavaScript 天才世界的一扇大门。它是世界上最大的软件注册表，每星期大约有 30 亿次的下载量，包含超过 600000 个 包（package） （即，代码模块）。来自各大洲的开源软件开发者使用 npm 互相分享和借鉴。包的结构使您能够轻松跟踪依赖项和版本。
同时，你可以在`Node.js`和`package.js`中require一个包并通过npm来下载到当前目录中`的node_module`中。

例如默认安装的Laravel中的package.js:

```
"devDependencies": {
        "axios": "^0.18",
        "bootstrap": "^4.0.0",
        "popper.js": "^1.12",
        "cross-env": "^5.1",
        "jquery": "^3.2",
        "laravel-mix": "^2.0",
        "lodash": "^4.17.4",
        "vue": "^2.5.7"
```

<br>
<br>

## 在MAC OS上使用Valet实现Laravel的coding环境

### 1. 安装Valet
>需要注意，Valet只支持MAC，如果需要在windows上构建环境可以使用Laravel推荐的homestead。

* 安装Laravel: `composer global require "laravel/installer"`，修改`~/.bash_profile`，把`~/.composer/vendor/bin`加入到文件中，以便`laravel`可以随地运行。
例如：

```
export PATH=$PATH:$HOME/.composer/vendor/bin
export PATH="/usr/local/opt/php@7.1/bin:$PATH"
export PATH="/usr/local/opt/php@7.1/sbin:$PATH"
```

* 首先，更新homebrew到最新的版本: `brew update`
* 通过homebrew安装PHP7.2: `brew install homebrew/php/php72`
* 通过homebrew安装mysql: `brew install mysql`
* 通过compower安装Valet: `composer global require laravel/valet`
* 运行`valet install`来安装Valet，同时Valet将随着系统一起启动。
* 如果需要修改domain的话使用: `valet domain <tld-name>` 比如 `app`，则访问的URL会变成`<site>.app`
* 将httproot目录进行绑定: 在需要绑定的目录中运行 
`valet park`。完成绑定后既可以通过浏览器进行访问。

### 2. 使用GitHub仓库进行项目管理
>相关SSH信任关系建立请参考  https://github.com/settings/keys

* 安装好git之后，在项目当下的目录运行: `git init`，进行git仓库创建。
* 完成仓库创建之后就可以进行将目录下所有文件都加入至仓库: `git add -A`。
* 之后就可以进行第一次commit: `git commit -m "First commit"`
* 之后就可以将GitHub的仓库进行定义: `git remote add origin git@github.com:yangdi611/EasyBookmark.git`，同时在github.com中增加同名仓库: `EasyBookmark`。
<br>
<br>
OK，目前开发环境都已经具备了，下面将开始我们的开发。

<br>
<br>

## 开始构建我们第一个app，Easybookmark
>经过之前的一次跟laravel-china的练习，基本了解了MVC的运作方式，下面开始半借鉴课程的内容，半自己开发一个书签类应用作为练习。

### 1. 使用Laravel生成app

* 使用laravel在~/sites目录中生成一个名为easybookmark的应用: `$ laravel new easybookmark`。
* 在~/sites目录中，laravel帮我们生成了一个目录~/sites/easybookmark，这个目录下已经预装了laravel所需的建站内容。下面我们运行: `$ cp .env.sample .env`生成.env环境定义文件并进行响应的修改。同时，运行: `$ php artisan key:generate`生成app的密匙。
* `.env`文件需要修改的地方如下：

修改环境APP名称为`"Easy Bookmark"`和APP URL为`http://easybookmark.test`

```
APP_NAME="Easy Bookmark"
APP_ENV=local
APP_KEY=base64:xXb//rldyTmTjJfoBd7LoBh+xlwhv70LNa6g0M95bGE=
APP_DEBUG=true
APP_URL=http://easybookmark.test
```
<br>修改mysql的配置信息：

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easybookmark
DB_USERNAME=root
DB_PASSWORD=
```

<br>因为我们现在还有mail server所以将mail的方式改为log，如果后续需要添加smtp方式，则需要把这部分配置也进行更改:

```
MAIL_DRIVER=log
```

### 2.我们开始生成静态地址
#### 2.1. 通过git开始一个分支

使用`$ git status`查看目前是否在master分支下并且没有需要更新的地方。

```
On branch master
Your branch is up-to-date with 'origin/master'.

nothing to commit, working tree clean 
```

如果没有在master分支下则运行: `$ git checkout master`
如果在master分之下我们需要进行建立一个新的叫static-pages的分支: `$ git checkout -b static-pages`

同时删除一个无用的blade页面（laravel自带的欢迎页面，当然，你也可以把它改名）: `$ rm resources/views/welcome.blade.php`

#### 2.2. 了解Laravel的完成访问过程
* 打开浏览器在地址栏输入 URL 并访问；
* 路由将 URL 请求映射到指定控制器上；
* 控制器收到请求，开始进行处理。如果视图需要动态数据进行渲染，则控制器会开始从模型中读取数据；
* 数据读取完毕，将数据传送给视图进行渲染；
* 视图渲染完成，在浏览器上呈现出完整页面

如下图：

![] (https://fsdhubcdn.phphub.org/uploads/images/201705/13/1/VptHggpp0v.png)

#### 2.3. 下面开始构建三个静态页面
##### 修改routes/web.php

```
<?php

Route::get('/', 'StaticPagesController@home');
Route::get('/help', 'StaticPagesController@help');
Route::get('/about', 'StaticPagesController@about');
```
在上面代码的代码中，我们为 get 方法传递了两个参数，第一个参数指明了 URL，第二个参数指明了处理该 URL 的控制器动作。get 表明这个路由将会响应 GET 请求，并将请求映射到指定的控制器动作上。比方说，我们向 http://easybookmark.test/ 发出了一个请求，则该请求将会由 StaticPagesController 的 home 方法进行处理。我们将在下节创建 StaticPagesController，为你讲解控制器在收到请求后如何进行相关操作。

在 Laravel 中我们较为常用的几个基本的 HTTP 操作分别为 GET、POST、PATCH、DELETE。

* GET 常用于页面读取
* POST 常用于数据提交
* PATCH 常用于数据更新
* DELETE 常用于数据删除

在这四个动作中，PATCH 和 DELETE 是不被浏览器所支持的，但我们可以通过在提交中表单中做一些手脚，让服务器以为这两个动作是从浏览器中发出的一样，后面我会具体讲解如何在表单中通过添加隐藏域的方式来欺骗服务器。这里你只需要有个大概的印象即可。

##### 生成静态页面的控制器

`$ php artisan make:controller StaticPagesController`

我们可以发现，这个命令会在app/Http/Controllers/下面生成一个`StaticPagesController.php`的文件。

文件如下:

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //
}
```
namespace 代表命名空间，类似文件系统的目录的概念，不同目录中的文件可以是同名文件。
`use`是引用PHP文件中要使用的类。
此外，静态页面控制器中还定义了一个`StaticPagesController`的类，这个继承父类`app/Http/Controllers/Controller`。

##### 添加静态页面视图
要在控制器中指定渲染某个视图，则需要使用到 `view` 方法，`view` 方法接收两个参数，第一个参数是视图的路径名称，第二个参数是与视图绑定的数据，第二个参数为可选参数。当前先不用第二个参数。

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        return view('static_pages/home');
    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }
}
```

`return view('static_pages/home');`会定向指向`resources/views/static_pages/home`的blade（刀片）上`home.blade.php`。

下面建立并编辑`home.blade.php` `help.blade.php` `about.blade.php`，拿home举例，不再赘述。

```
<!DOCTYPE html>
<html>
<head>
  <title>Sample App</title>
</head>
<body>
  <h1>主页</h1>
</body>
</html>
```

##### 使用通用视图

你可能已经注意到了，前面我们创建的几个视图里面包含着一些重复的代码，这明显违反了 DRY（Don't repeat yourself）原则，导致代码变得不够灵活、简洁。因此我们需要对页面进行重构，把多余的代码从视图中抽离出来，单独创建一个默认视图来进行存放通用代码。

我们给应用创建了一个 `default` 视图，并将其放在 `layouts` 文件夹中，`default` 视图将作为整个应用的基础视图。实际上你只要保证视图文件被放置在 `resources/views` 目录下即可，Laravel 对视图的文件夹和文件命名并没有限制，我将 `default` 文件放在 `layouts` 文件下，只是为了让应用的目录结构让人更好理解。

```
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title' , 'Sample')</title>
  </head>
  <body>
    @yield('content')
  </body>
</html>
```

我们可以看到，在`default`中，我们声明了一个`content`区块内容，而Laravel的blade模板支持继承，这意味多个子视图可以共用父视图提供的视图模板。接下来让我们修改之前创建的首页视图文件，来学习下如何使用 Blade 模板的继承。
同时，`@yield('title' , 'Sample')`有两个参数，第一个参数是这个声明的名字，第二个参数Sample是他的default值。

home.balde.php
```
@extends('layouts.default')
@section('title' , '主页')
@section('content')
  <h1>主页</h1>
@stop
```
这样，我们就可以把layout.default这个模板嵌套进来，这样我们省去了每次都需要修改很多blade的麻烦。

##### Artisan

Artisan 是 Laravel 提供的 CLI（命令行接口），它提供了非常多实用的命令来帮助我们开发 Laravel 应用。前面我们已使用过 Artisan 命令来生成应用的 App Key 和控制器。在本教程中，我们会用到以下 Artisan 命令，你也可以使用 `php artisan list` 来查看所有可用的 Artisan 命令。

|命令 |	说明|
|---|---|
|php artisan key:generate |	生成 App Key|
|php artisan make:controller| 	生成控制器|
|php artisan make:model 	|生成模型|
|php artisan make:policy 	|生成授权策略|
|php artisan make:seeder| 	生成 Seeder 文件|
|php artisan migrate 	|执行迁移|
|php artisan migrate:rollback 	|回滚迁移|
|php artisan migrate:refresh 	|重置数据库|
|php artisan db:seed 	|填充数据库|
|php artisan tinker 	|进入 tinker 环境|
|php artisan route:list 	|查看路由列表|







