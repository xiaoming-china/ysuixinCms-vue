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
<div class="nav-box">
  <div class="container">
      <nav class="navbar nav-nav-box navbar-default navbar-fixed-top nav-top" role="navigation">
    <div class="container">
       <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#nav-sub">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">意随心</a>
    </div>
    <div class="collapse navbar-collapse" id="nav-sub">
        <ul class="nav navbar-nav navbar-right">
            <li class="active">
              <a href="#">首页</a>
            </li>
            {nav}
                {foreach from=$list item=v}
                    {if $v.children|@count neq 0}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                              {$v.name}
                              <b class="caret"></b> 
                            </a> 
                            <ul class="dropdown-menu">
                            {foreach from=$v.children item=vv}
                                <li><a href="{$vv.nav_url}">{$vv.name}</a></li> 
                            {/foreach} 
                            </ul> 
                        </li>
                    {else}
                        <li>
                          <a href="{$v.url}">{$v.name}</a>
                        </li>
                    {/if}
                {/foreach}  
            {/nav}
        </ul>
    </div>
    </div>
  </nav>
  </div>
</div>
<!--导航结束-->
    <div class="container main-content" id="articleList">
      <div class="row">
            <div class="col-md-12">
              <div class="blog-right-box">
              <!--内容列表开始-->
                <div class="blog-item">
                  <div class="blog-item-header">
                    <h4>
                      <a href = {url}>{title}</a>
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
                </div>
              <!--内容列表结束-->
              </div>
            </div>
        </div>
    </div>
    </body>
</html>

