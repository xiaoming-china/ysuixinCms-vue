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
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<div class="cover" style="margin-top: 40px;">
    <div class="row" style="margin: 0;">
        <div class="small-12 medium-12 large-12 columns intro-text">
            <div class="fadeInDown">
                <p>一直相信</p>
                <p>即使一直一个人沉浸在自己的世界里</p>
                <p>最终，也会</p>
                <p>在某个世界</p>
                <p>某个地点</p>
                <p>找到某些自己真正想要的东西</p>
            </div>
            <div class="small-6 medium-6 large-6 columns">
                <a href="/Home/Blog/index.html" class="btnService right fadeIn">进入博客
                </a>
            </div>
            <div class="small-6 medium-6 large-6 columns">
                <a href="/Home/About/index.html" class="btnService left fadeIn">
                关于
                </a>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
<script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?1873856b1a96138cdd16521be8a1dc50";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
</script>