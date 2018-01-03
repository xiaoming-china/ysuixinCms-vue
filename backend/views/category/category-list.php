<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-栏目列表</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <header class="nav-header-box">
    <div class="logo">logo</div>
    <div class="nav-list">
      <ul>
        <li class="on">首页</li>
        <li>控制面板</li>
        <li>内容</li>
        <li>用户</li>
        <li>模块</li>
        <li>设置</li>
      </ul>
    </div>
    <div class="nav-other">
      <span>欢迎你：管理员 <a href="main/login.html">【退出】</a></span>
      <span></span>
    </div> 
  </header>
  <div class="main-content">
    <!--左边二级导航开始-->
    <div class="left-nav">
      <ul>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 系统信息</span>
          <div class="sub-nav-item">
            <a href="main/main.html" target="main">服务器信息</a>
            <a href="/admin/person-info/person-info">修改个人信息</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 内容管理</span>
          <div class="sub-nav-item">
            <a href="content/publish_content.html" target="main">发布管理</a>
            <a href="comment/comment.html" target="main">评论管理</a>
            <a href="enclosure/enclosure.html" target="main">附件管理</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 模型管理</span>
          <div class="sub-nav-item">
            <a href="model/model.html" target="main">模型列表</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 安全设置</span>
          <div class="sub-nav-item">
            <a href="main/main.html" target="main">角色管理</a>
            <a href="main/main.html" target="main">权限管理</a>
            <a href="main/main.html" target="main">修改密码</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 站点设置</span>
          <div class="sub-nav-item">
            <a href="template/template.html" target="main">站点模板设置</a>
            <a href="config/config-basic.html" targat="main">站点参数设置</a>
          </div>
        </li>

      </ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">栏目列表</a>
      	</div>
      </div>
      <div class="card">
        <a class="a-basic-btn" href="/admin/category/add-category">
          <i class="icon-plus" style="color:#006699;"></i> 添加栏目
        </a>
      </div>
<!--       <div class="card">
        <div class="first-title">搜索</div>
            <div class="search-box">
                  <div>
                    <i-Input v-model="searchData.keyworlds" placeholder = "名称 / 标识 / 描述">
                    </i-Input>
                  </div>
                  <div>
                    <i-select v-model="searchData.status">
                        <i-option value="-1">全部</i-option>
                        <i-option value="1">开启</i-option>
                        <i-option value="0">禁用</i-option>
                    </i-select>
                  </div>
              <i-button @click="getCategoryList();">搜索</i-button>
            </div>
      </div> -->
      <!--模型列表-->
      <div class="card">
		<table class="table table72 table-striped">
			<thead>
				<tr>
	        <th style="width: 20px;">
	          <Checkbox v-model="check_all"></Checkbox>
	        </th> 
					<th style="width: 440px;text-align: left;padding-left: 40px;">名称</th>
					<th style="width: 80px;">所属模型</th>
          <th style="width: 40px;">栏目类型</th>
			    <th style="width: 110px;">操作</th>
				</tr>
			</thead> 
			<tbody>
			  <tr v-if="categoryList.length == 0">
			    <td colspan="8">
			      <p class="t-center">暂无数据</p>
			    </td>
			  </tr>
				<tr v-for="(value,key) in categoryList" :key="key" v-else>
			    <td><Checkbox v-model="check_all":value="value.catid"></Checkbox></td> 
					<td v-html = "value.html + value.catname" style="text-align: left;padding-left: 40px;"></td> 
					<td>{{value.model_name}}</td>
          <td>
            <span v-if = "value.type == 1" >内部栏目</span>
            <span v-if = "value.type == 2" >单页面</span>
          </td>
			        <td>
			          <span>
                   <a href="#"@click="location(2,value.catid,'');">编辑栏目</a>
                   &nbsp;&nbsp;|&nbsp;&nbsp;
                </span>
			          <span>
                   <a href="#"@click="deleteCategory(key,value.catid);">删除栏目</a>
                   &nbsp;&nbsp;|&nbsp;&nbsp;
                </span>
			          <span>
			            <a href="#" v-if="value.type == 1" @click="location(1,value.catid,value.modelid);">
                  查看内容&nbsp;&nbsp;|&nbsp;&nbsp;
                  </a>
			          </span>
                <span>
                  <a href="#" v-if="value.type == 1"  @click="location(3,value.catid,value.modelid);">发布内容</a>
                  <a href="#" v-if="value.type == 2"  @click="location(3,value.catid,value.modelid);">编辑单页</a>
                </span>
			        </td>
				</tr>
			</tbody>
		</table>
      </div>
      <!--字段列表-->
    </div>
    <!--主体内容区结束-->

  </div>

  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="http://vuejs.org/js/vue.min.js"></script>
  <script src="http://unpkg.com/iview/dist/iview.min.js"></script>
  <script src="/public/admin/js/main.js"></script>
  <script src="/public/admin/js/menu.js"></script>


<script>
    new Vue({
        el: '#app',
        data:{
          loading:false,
          categoryList:[],
          searchData:{
            keyworlds:'',
            status:'-1',
          },
          check_all:false,
        },
        mounted: function() {
          this.getCategoryList();
        },
        methods: {
          //更改栏目状态
          changeStatusCategory:function(id,type,key) {
            //2禁用1开启;开启 or 禁用弹窗
            var _that = this;
            var title = type == 1 ? '开启' : '禁用';
            var info = '';
			info += '确定禁用此栏目？</br>';
			info += '注意：</br>1)、禁用会将栏目的子级全部禁用;</br>';
			info += '2)、如果此栏目或子级栏目有数据，将不能禁用;';
            this.$Modal.confirm({
                title:'操作确认',
                width:300,
                loading:true,
                content:'<p>是否'+title+'?</p>',
                onOk: () => {
                  var params = {
                    'id':id,
                    'status':type
                  };
                  $ajax(
                    '/admin/field/change-field-status', 
                    params, 
                    'post',
                    function(res){
                      _that.$Message.success(title+'成功');
                      _that.$Modal.remove();
                      _that.fieldList[key].status = type == 1 ? 1 : 2;
                    },
                    function(res){
                      _that.$Message.warning(title+'失败;'+res.info);
                    },
                  );
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });
          },
          //删除栏目
          deleteCategory:function(key,id){
            var _that = this;
          	var info = '';
      			info += '确定删除此栏目？</br>';
      			info += '注意：</br>1)、删除栏目会将栏目的子级全部删除;</br>';
      			info += '2)、如果此栏目或子级栏目有数据，将不能删除;';
            this.$Modal.confirm({
                title:'删除确认',
                width:400,
                loading:true,
                content:info,
                onOk: () => {
                  _that.loading = true;
                  var params = {
                    'id':id
                  };
                  $ajax(
                    '/admin/category/del-category', 
                    params,
                    'post',
                    function(res){
                      _that.$Message.success('删除成功');
                      _that.$Modal.remove();
                      _that.getCategoryList();
                    },
                    function(res){
                      _that.$Message.warning('删除失败;'+res.info);
                    },
                  );
                  _that.loading = false;
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });

          },
          //获取栏目列表
          getCategoryList:function(){
            var _that = this;
            $ajax(
              '/admin/category/category-list',
              _that.searchData, 
              'post',
              function(res){
                _that.categoryList = res.data;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          //跳转字段管理
          location:function(type,categoryId,modelId){
          	var url = '';
          	switch(type){
          	  case 1:
                url = '/admin/content/list?catid='+categoryId+'&modelid='+modelId;
          		break;
          	  case 2:
                url = '/admin/category/edit-category?catid='+categoryId;
          		break;
              case 3:
                url = '/admin/content/add-content?catid='+categoryId+'&modelid='+modelId;
              break;
          	}
            //location.href = url;
            window.open(url);
          },
          	//获取url参数
    			request: function (name, url) {
    				url = url || window.location.search;
    				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    				var r = url.substr(1).match(reg);
    				if (r != null) return (r[2]);
    				return '';
    			},
        }
    })
</script>



</body>
</html>