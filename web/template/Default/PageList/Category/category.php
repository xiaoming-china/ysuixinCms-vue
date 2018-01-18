<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title>{{$title}}</title>
    <meta name="keywords" content="{{$keywords}}"/>
    <meta name="description" content="{{$description}}"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/home/style/basic.css" />
    <link rel="stylesheet" href="/public/home/style/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery.nicescroll/3.6.0/jquery.nicescroll.js"></script>
    <script src="/public/home/js/basic.js"></script>
  </head>
  <body>
<!--导航开始-->
{{include file="../header.php"}}
<!--导航结束-->
    <div class="container main-content" id="articleList">
      <div class="row">
            <div class="col-md-12">
              <div class="blog-right-box">
              <!--内容列表开始-->
              {{contentList num="2"}}
                {{foreach from=$list item=v}}
                  <div class="blog-item">
                    <div class="blog-item-header">
                      <h4>
                        <a href = {{$v.url}}>{{$v.title}}</a>
                      </h4>
                      <p class="header-info"> 
                        <span>time：<em>{{date('Y-m-d H:i:s',$v.created_at)}}</em></span>
                        <span>view：<em>{{$v.view}}</em></span>
                      </p>
                    </div>
                    <div class="blog-item-content">
                        <div class="row">
                          <div class="col-md-12 blog-content">
                          <img src="{{$v.thumb}}" class=" pull-left" width="300px" height="200px">
                           <p>{{$v.desc}}</p>
                          </div>
                        </div>
                    </div>
                  </div>
                {{/foreach}} 
              {{/contentList}}
              <!--内容列表结束-->
              {{$page}}
              </div>
            </div>
        </div>
    </div>
    {{include file="../footer.php"}}
    
   


