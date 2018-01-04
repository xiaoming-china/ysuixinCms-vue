$(document).ready(function() {
      //获取全部菜单,先查询本地存储，没有，再请求接口
       var menuList = JSON.parse(localStorage.getItem("menuList"));
       if(menuList == null || menuList.length == 0){
          $.post('/admin/menu/menu-list', function(res) {
              if(res.status == 1){
                pushTopMenu(res.data);
                localStorage.setItem("menuList",JSON.stringify(res.data));
              }else{
                $('#seconde-menu').empty();//清空左侧菜单
                $('#seconde-menu').append('二级菜单获取失败,<br>请重试');
                console.log('请求服务器错误');
              }
          });
       }else{
          pushTopMenu(menuList);
       }
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
      //    location.href = href;
      // });
      //点击顶部菜单，查找二级和三级菜单。ps菜单最多只能三级
      $(document).on('click', '.top-munu-item', function(event) {
        $(this).addClass('on').siblings().removeClass('on');
        $('#seconde-menu').empty();//清空左侧菜单
        var seconde_menu = '';
        var item = $(this).attr('item');
        localStorage.setItem("topIndex",item);
        secondeMenu(menuList,item);//二级菜单
      });
      //push顶部菜单,并且选中上一页选中的菜单
       function pushTopMenu(menuList){
          var top_menu = '';
          $.each(menuList, function(index, val) {
             top_menu += '<li item = "'+index+'" class="top-munu-item">'+val['name']+'</li>';
           });
          $('#top-menu').append(top_menu);
          var topIndex = localStorage.getItem("topIndex");
          if(topIndex != null){
            $('#top-menu > li').eq(topIndex).addClass('on').siblings().removeClass('on');
          }else{
            $('#top-menu > li').eq(0).addClass('on').siblings().removeClass('on');
          }
          secondeMenu(menuList,parseInt(topIndex));
       }
       //处理二级菜单
       function secondeMenu(menuList,item){
        var seconde_menu = '';
          if(menuList[item].child != null && menuList[item].child.length > 0){
            $.each(menuList[item].child, function(index, val) {
               seconde_menu += '<li class="parent-nav-item">';
               seconde_menu += '<span is-selected="true"> <s class="icon-minus"></s> '+val['name']+'</span>';
               // 三级菜单开始
               if(val['child'] && val['child'].length > 0){
                  seconde_menu += '<div class="sub-nav-item">';
                  $.each(val['child'], function(i, v) {
                     seconde_menu += '<a href="'+v['url']+'">'+v['name']+'</a>';
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
       }

});