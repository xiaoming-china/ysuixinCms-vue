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
          <?php foreach($data as $k => $v): ?>
              <?php if(!empty($v['children'])): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                      <?=$v['name'];?>
                      <b class="caret"></b> 
                    </a> 
                    <ul class="dropdown-menu">
                      <?php foreach($v['children'] as $kk => $vv): ?>
                        <li><a href="<?=$vv['nav_url'];?>"><?=$vv['name'];?></a></li> 
                      <?php endforeach;  ?>
                    </ul> 
                </li> 
              <?php else: ?>
                <li>
                  <a href="<?=$v['nav_url'];?>"><?=$v['name'];?></a>
                </li>
              <?php endif; ?>
          <?php endforeach;  ?>
        </ul>
    </div>
    </div>
  </nav>
  </div>
</div>