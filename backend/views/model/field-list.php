<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-字段管理</title>
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
			<a href="" class="crumbs">字段列表</a>
      	</div>
      </div>
      <div class="card">
        <a class="a-basic-btn" href="#" @click="location(1);">
          <i class="icon-plus" style="color:#006699;"></i> 添加字段
        </a>
      </div>
      <div class="card">
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
              <i-button @click="getFieldList();">搜索</i-button>
            </div>
      </div>
      <!--模型列表-->
      <div class="card">
		<table class="table table72 table-striped">
			<thead>
				<tr>
	        <th style="width: 40px;">
	          <Checkbox v-model="check_all"></Checkbox>
	        </th> 
					<th style="width: 40px;">编号</th> 
					<th style="width: 80px;">名称</th> 
					<th style="width: 80px;">标识</th> 
					<th style="width: 120px;">是否系统字段</th> 
					<th style="width: 40px;">状态</th>
			        <th style="width: 110px;">添加时间</th>
			        <th style="width: 128px;">操作</th>
				</tr>
			</thead> 
			<tbody>
			    <tr v-if="fieldList.length == 0">
			          <td colspan="8">
			              <p class="t-center">暂无数据</p>
			          </td>
			    </tr>
				<tr v-for="(value,key) in fieldList" :key="key" v-else>
			        <td><Checkbox v-model="check_all":value="value.id"></Checkbox></td> 
			        <td>{{key + 1}}</td>
					<td>{{value.name}}</td> 
					<td>{{value.e_name}}</td> 
					<td>
			          <p v-if="value.is_style == 1">√</p>
			          <p v-else>✘</p>
			        </td> 
					<td>
			          <p v-if="value.status == 1">√</p>
			          <p v-else>✘</p>
			        </td> 
					<td>{{getLocalTime(value.created_at)}}</td>
			        <td v-if="value.is_style != 1">
			          <span><a href="#"@click="location(2,value.id);">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
			          <span><a href="#"@click="deleteField(key,value.id);">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
			          <span>
			            <a href="#" v-if="value.status == 1" @click="changeStatusField(value.id,2,key);">禁用</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			            <a href="#" v-else @click="changeStatusField(value.id,1,key);">开启</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			          </span>
			        </td> 
			        <td v-if="value.is_style == 1">
			          系统字段，暂不可操作
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
          modelId:'',
          loading:false,
          fieldList:[],
          searchData:{
          	modelId:'',
            keyworlds:'',
            status:'-1',
          },
          check_all:false,
        },
        mounted: function() {
		      this.modelId            = this.request('model_id');
		      this.searchData.modelId = this.request('model_id');
          this.getFieldList();
        },
        methods: {
          //更改字段状态
          changeStatusField:function(id,type,key) {
            //2禁用1开启;开启 or 禁用弹窗
            var _that = this;
            var title = type == 1 ? '开启' : '禁用';
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
                    false
                  );
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });
          },
          //删除模型
          deleteField:function(key,id){
            var _that = this;
            this.$Modal.confirm({
                title:'删除确认',
                width:300,
                loading:true,
                content:'<p>是否删除?</p>',
                onOk: () => {
                  _that.loading = true;
                  var params = {
                    'id':id
                  };
                  $ajax(
                    '/admin/field/del-field', 
                    params,
                    'post',
                    function(res){
                      _that.$Message.success('删除成功');
                      _that.$Modal.remove();
                      _that.getFieldList();
                    },
                    function(res){
                      _that.$Message.warning('删除失败;'+res.info);
                    },
                    false
                  );
                  _that.loading = false;
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });

          },
          //获取字段列表
          getFieldList:function(){
            var _that = this;
            $ajax(
              '/admin/field/field-list', 
              _that.searchData, 
              'get',
              function(res){
                _that.fieldList = res.data.list;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          //跳转字段管理
          location:function(type,fieldId){
          	var url = '';
          	switch(type){
          	  case 1:url = '/admin/field/add-field?model_id='+this.modelId;
          		break;
          	  case 2:url = '/admin/field/edit-field?model_id='+this.modelId+'&field_id='+fieldId;
          		break;
          	}
            location.href = url;
            //window.open(url);
          },
          //格式化时间戳
          getLocalTime:function(nows) {
            if(nows == "" || nows == null){
                return  "";
            }else{
                var now  = new Date(parseInt(nows)*1000);
                var year=now.getFullYear();
                var month=now.getMonth()+1;
                var date=now.getDate();
                var hour=now.getHours().toLocaleString().split("").length == 1 ?"0"+now.getHours():now.getHours();
                var minute=now.getMinutes().toLocaleString().split("").length == 1 ?"0"+now.getMinutes():now.getMinutes();
                var second=now.getSeconds().toLocaleString().split("").length == 1 ?"0"+now.getSeconds():now.getSeconds();
                return year+"-"+month+"-"+date+"  "+hour+":"+minute+":"+second;
            }
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