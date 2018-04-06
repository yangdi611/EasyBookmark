# 学习Laravel笔记


[TOC]

<br><br>
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
        
###2. Homebrew

Homebrew 是用来安装MAC OS上没有预装但是在开发或者其他过程中需要用到的东西。Homebrew 会将软件包安装到独立目录，并将其文件软链接至 `/usr/local `。

Homebrew 不会将文件安装到它本身目录之外，所以您可将 Homebrew 安装到任意位置。即所有软件包都会安装至homebrew目录下，默认安装至`usr/local/Cellar`下。

###3. git
git是一个软件版本控制工具，通过git，我们可以更方便的建立分支并在分支上进行多次开发等功能。

###4. npm
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


##在MAC OS上使用Valet实现Laravel的coding环境

###1. 安装Valet
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

###2. 使用GitHub仓库进行项目管理
>相关SSH信任关系建立请参考  https://github.com/settings/keys

* 安装好git之后，在项目当下的目录运行: `git init`，进行git仓库创建。
* 完成仓库创建之后就可以进行将目录下所有文件都加入至仓库: `git add -A`。
* 之后就可以进行第一次commit: `git commit -m "First commit"`
* 之后就可以将GitHub的仓库进行定义: `git remote add origin git@github.com:yangdi611/EasyBookmark.git`，同时在github.com中增加同名仓库: `EasyBookmark`。
<br>
<br>
OK，目前开发环境都已经具备了，下面将开始我们的开发。
 
##开始构建我们第一个app，Easybookmark
>经过之前的一次跟laravel-china的练习，基本了解了MVC的运作方式，下面开始半借鉴课程的内容，半自己开发一个书签类应用作为练习。

###1. 使用Laravel生成app

* 使用laravel在~/sites目录中生成一个名为easybookmark的应用: `laravel new easybookmark`。
* 在~/sites目录中，laravel帮我们生成了一个目录~/sites/easybookmark，这个目录下已经预装了laravel所需的建站内容。下面我们运行: `cp .env.sample .env`生成.env环境定义文件并进行响应的修改。同时，运行: `php artisan key:generate`生成app的密匙。
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









