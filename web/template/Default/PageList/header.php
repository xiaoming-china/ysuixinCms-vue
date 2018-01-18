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
            {{nav}}
                {{foreach from=$list item=v}}
                    {{if $v.children|@count neq 0}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                              {{$v.name}}
                              <b class="caret"></b> 
                            </a> 
                            <ul class="dropdown-menu">
                            {{foreach from=$v.children item=vv}}
                                <li><a href="{{$vv.nav_url}}">{{$vv.name}}</a></li> 
                            {{/foreach}}
                            </ul> 
                        </li>
                    {{else}}
                        <li>
                          <a href="{{$v.url}}">{{$v.name}}</a>
                        </li>
                    {{/if}}
                {{/foreach}} 
            {{/nav}}
        </ul>
    </div>
    </div>
  </nav>
  </div>
</div>
<!--导航结束-->