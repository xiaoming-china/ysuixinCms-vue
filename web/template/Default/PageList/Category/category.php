<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title><?=$title?></title>
    <meta name="keywords" content="<?=$keywords?>"/>
    <meta name="description" content="<?=$description?>"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/home/style/basic.css" />
    <link rel="stylesheet" href="/public/home/style/index.css" />
    <link rel="stylesheet" href="/public/home/style/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/public/home/js/basic.js"></script>
  </head>
  <body>
<!--导航开始-->
<?= common\widgets\NavWidget::widget(['template' => 'nav']) ?>
<!--导航结束-->
    <div class="container main-content" id="articleList">
      <div class="row">
            <div class="col-md-3 hidden-xs main-pin">
              <div class="blog-left-box pin">
                <div class="search-box">
                    <div class="search bar7">
                      <form action="?" method="get">
                        <input type="text" placeholder="请输入您要搜索的内容..." name="keyword" value="">
                        <button type="submit"></button>
                      </form>
                    </div>
                </div>
                <div class="type-box">
                  <li class="type-list on">全部</li>
                  <li class="type-list">
                      {{v.name}}
                  </li>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="blog-right-box">
                <div class="blog-item">
                  <div class="blog-item-header">
                    <h4>
                      <a v-bind:href = v.url>{{v.title}}</a>
                    </h4>
                    <p class="header-info"> 
                      <span>time：<em>{{v.add_time}}</em></span>
                      <span>view：<em>{{v.view}}</em></span>
                    </p>
                  </div>
                  <div class="blog-item-content">
                      <div class="row">
                        <div class="col-md-12 blog-content">
                        <img  v-bind:src="v.thumb" class=" pull-left" width="300px" height="200px">
                         <p>{{v.desc}}</p>
                        </div>
                      </div>
                  </div>
                  <div class="blog-item-fotter">
                      <span class="tag">tags：</span>
                      <a href="#" v-for="t in v.tags">
                        {{t}}
                      </a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    </body>
</html>

