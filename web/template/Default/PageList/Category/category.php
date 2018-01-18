<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title><?=$seo['title']?></title>
    <meta name="keywords" content="<?=$seo['keywords']?>"/>
    <meta name="description" content="<?=$seo['description']?>"/>
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
            <div class="col-md-12">
              <div class="blog-right-box">
              <!--内容列表开始-->
              <?= common\widgets\ContentWidget::widget([
                'template' => '
                      <div class="blog-item">
                        <div class="blog-item-header">
                          <h4>
                            <a href = {url}>{title}111</a>
                          </h4>
                          <p class="header-info"> 
                            <span>time：<em>{created_at}</em></span>
                            <span>view：<em>{view}</em></span>
                          </p>
                        </div>
                        <div class="blog-item-content">
                            <div class="row">
                              <div class="col-md-12 blog-content">
                              <img src="{thumb}" class=" pull-left" width="300px" height="200px">
                               <p>{desc}</p>
                              </div>
                            </div>
                        </div>
                        <div class="blog-item-fotter">
                            <span class="tag">tags：</span>
                            <a href="#" v-for="t in v.tags">
                              {{t}}
                            </a>
                        </div>
                      </div>'
              ]) ?>
              <!--内容列表结束-->
              </div>
            </div>
        </div>
    </div>
    </body>
</html>

