$(document).ready(function() {
      //获取全部菜单
      $.post('/admin/menu/menu-list', function(data) {
          if(data.status == 1){
             var top_menu = all_menu = '';
             all_menu = data.data;
             $.each(data.data, function(index, val) {
               top_menu += '<li item = "'+index+'" class="top-munu-item">'+val['name']+'</li>';
             });
            $('#top-menu').append(top_menu);//push顶部菜单
          }else{
            $('#seconde-menu').empty();//清空左侧菜单
            $('#seconde-menu').append('二级菜单获取失败,<br>请重试');
            console.log('请求服务器错误');
          }
      });
      //左侧导航点击展开或者隐藏三级菜单
      $(document).on('click', '.parent-nav-item>span', function(event) {
        var text = $(this).find('s').text();
        var selected = $(this).attr('is-selected');
        if(selected == 'true'){
          $(this).attr("is-selected", 'false');
          $(this).next('.sub-nav-item').css({"display":'none'});
          $(this).find('s').removeClass('icon-minus').addClass('icon-plus');
        }else{
          $(this).attr("is-selected", 'true');
          $(this).next('.sub-nav-item').css({"display":'block'});
          $(this).find('s').removeClass('icon-plus').addClass('icon-minus');
        }
      });
      //左侧菜单点击事件
      // $(document).on('click', '.sub-nav-item>a', function(event) {
      //    event.preventDefault();
      //    var href = $(this).attr('href');
      //    $('#iframe-main').attr('src',href);
      // });
      //点击顶部菜单，查找二级和三级菜单。ps菜单最多只能三级
      $(document).on('click', '.top-munu-item', function(event) {
        $(this).addClass('on').siblings().removeClass('on');
        $('#seconde-menu').empty();//清空左侧菜单
        var seconde_menu = '';
        var item = $(this).attr('item');
        //二级菜单
        if(all_menu[item].child && all_menu[item].child.length > 0){
          $.each(all_menu[item].child, function(index, val) {
             seconde_menu += '<li class="parent-nav-item">';
             seconde_menu += '<span is-selected="true"> <s class="icon-minus"></s> '+val['name']+'</span>';
             // 三级菜单开始
             if(val['child'] && val['child'].length > 0){
                seconde_menu += '<div class="sub-nav-item">';
                $.each(val['child'], function(i, v) {
                   seconde_menu += '<a href="'+v['url']+'" target="main">'+v['name']+'</a>';
                });
                seconde_menu += '</div>';
             }
             // 三级菜单结束
             seconde_menu += '</li>';
          });
        }else{
          seconde_menu = '';
        }
        $('#seconde-menu').append(seconde_menu);
      });

});