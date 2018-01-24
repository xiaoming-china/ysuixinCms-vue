<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title>{{$data['title']}}</title>
    <meta name="keywords" content="{{$data['keywords']}}"/>
    <meta name="description" content="{{$data['desc']}}"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/home/style/basic.css" />
    <link rel="stylesheet" href="/public/home/style/index.css" />
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
<!--导航开始-->
{{include file="../header.php"}}
<!--导航结束-->
<div class="container main-content">
  <div class="row">
        <div class="col-md-12">
          <div class="blog-right-box" id="articllDetail">
            <div class="blog-item">
              <div class="blog-item-header">
                <h4 style="text-align:center;">
                   {{$data['title']}}
                </h4>
                <p class="header-info" style="text-align:right;">
                  <span>time：<em>{{date('Y-m-d H:i:s',$data['created_at'])}}</em></span>
                  <span>view：<em>{{$data['view']}}</em></span>
                </p>
              </div>
              <div class="blog-item-detailed">
                  <div class="row">
                    <div class="col-md-12 blog-content">
                     <p>{{$data['content']}}</p>
                    </div>
                  </div>
              </div>
              <div class="blog-comment-box">
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
    
    {{include file="../footer.php"}}