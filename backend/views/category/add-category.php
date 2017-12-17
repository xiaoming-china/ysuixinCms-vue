<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-添加栏目</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <style>
      .ivu-input-wrapper,.ivu-select{
        display: table !important; 
        width: 25% !important;
      }
      .add-table{
        width: 100%;
      }
      .add-table>tbody>tr{
        height: 70px;
        line-height:18px;
        border-bottom: 1px solid red !important;
      }
      .add-table>tbody>tr>.title{
        width:200px;
        text-align:left;
      }
      .ivu-form .ivu-form-item-label {
          vertical-align: middle;
          float: left;
          font-size: 12px;
          color: #495060;
          line-height: 20px;
          padding: 0; 
          box-sizing: border-box;
      }
      .ivu-form-item {
          zoom: 1;
          min-height: 60px;
          border-bottom: 1px dashed #dddee1;
      }
      .ivu-form-item-content {
            margin-left: 280px !important;
            position: relative !important;
            line-height: 32px !important;
            font-size: 12px !important;
            margin-bottom: 20px !important;
        }
      .field-title{
        font-weight: 700;
      }
      .field-params-table{
        width: 100%;
        text-align: left;
        font-weight: inherit !important;
        margin-bottom: 20px !important;
      }
      .field-params-table > tbody > tr{
        border-bottom: 1px dashed #dddee1;
        height: 50px;
      }
    </style>
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
			<a href="" class="crumbs">添加栏目</a>
      	</div>
      </div>
      <!--添加栏目-->
      <div class="card" style="padding-bottom: 30px;">
	          <i-Form ref="categoryInfo" :model="categoryInfo"
                                    :rules="categoryInfoInfoline"
                                    label-position="left"
                                    :label-width="200">
                <Form-Item label="名称" prop="catname">
                    <span slot="label">
                      <span class="field-title">栏目名称</span>
                      <p>中英文；最多10个字符；如企业简介</p>
                    </span>
    	              <i-Input type="text" v-model="categoryInfo.catname"></i-Input>
    	          </Form-Item>
    	          <Form-Item label="是否必填" prop="ismenu">
                  <span slot="label">
                    <span class="field-title">栏目类型</span>
                  </span>
                  <Radio-Group v-model="categoryInfo.type">
                      <Radio label="1">内部栏目</Radio>
                      <Radio label="2">单页面</Radio>
                  </Radio-Group>
                </Form-Item>
                <Form-Item label="字段类型" prop="modelid">
                    <span slot="label"><span class="field-title">所属模型</span>
                      <p>栏目所属的模型；用于生成数据字段</p>
                    </span>
                    <i-select v-model="categoryInfo.modelid" v-on:on-change="select_model">
                       <i-option value="">所属模型</i-option>
                       <i-option v-for="(value,key) in modelList" :value="value.id">{{value.name}}</i-option>
                    </i-select>
                </Form-Item>
                <Form-Item label="字段类型" prop="parentid">
                    <span slot="label"><span class="field-title">所属父级</span>
                    </span>
                    <i-select v-model="categoryInfo.parentid">
                        <i-option value="0">无</i-option>
						<i-option v-for="(value,key) in categoryList" :value="value.catid">
							<span v-html ="value.html + value.catname"></span>
						</i-option>
                    </i-select>
                </Form-Item>
                <Form-Item label="名称" prop="description">
                    <span slot="label">
                      <span class="field-title">栏目描述</span>
                      <p>最多30个字符；</p>
                    </span>
                        <i-Input v-model="categoryInfo.description" 
	                      size="small" 
	                      type="textarea"
	                      :autosize="{minRows: 5,maxRows: 15}">
                </Form-Item>
                <Form-Item label="名称" prop="image">
                    <span slot="label">
                      <span class="field-title">栏目缩略图</span>
                    </span>
    	              <i-Input type="text" v-model="categoryInfo.image"></i-Input>
    	        </Form-Item>
    	        <Form-Item label="名称" prop="url">
                    <span slot="label">
                      <span class="field-title">链接地址</span>
                      <p class="field-title">不为空则点击栏目跳转到此地址</p>
                    </span>
    	              <i-Input type="text" v-model="categoryInfo.url"></i-Input>
    	        </Form-Item>
                <Form-Item label="是否必填" prop="ismenu">
                  <span slot="label">
                    <span class="field-title">是否显示在导航</span>
                  </span>
                  <Radio-Group v-model="categoryInfo.ismenu">
                      <Radio label="1">是</Radio>
                      <Radio label="2">否</Radio>
                  </Radio-Group>
                </Form-Item>
                <div class="btn_wrap_pd">
                    <i-Button type="primary"
                    @click="addCategory('categoryInfo')"
                    :loading="loading"
                    style="width:92px;">
                      <span v-if="!loading">确定</span>
                      <span v-else>Loading...</span>
                    </i-Button>
                </div>
	          </i-Form>
      </div>
      <!--添加栏目-->
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
        data:function(){
        	return {
              categoryInfo: {
  	            catname: '',
  	            type:1,
  	            modelid: '',
  	            parentid:"0",
  	            description: '',
  	            image: '',
  	            url: '',
  	            ismenu: 1
              },
              modelList:[],
              categoryList:[],
              loading:false,
              categoryInfoInfoline: {
                catname: [
                    { required: true, message:'栏目名称不能为空',trigger:'blur'},
                    { max: 10, message:'栏目名称不能大于10个字符',trigger:'blur'}
                ],
                modelid: [
                    { required: true, message:'请选择所属模型',trigger:'blur'},
                ],
                // parentid: [
                //     { required: true, message:'请选择所属父级',trigger:'blur'}
                // ],
                description:[          
                    { max: 30, message:'名称描述不能大于50个字符',trigger:'blur'}
                ],
                url:[          
                    { url: true, message:'链接地址格式错误',trigger:'blur'}
                ]
              },
            }
        },
        mounted: function() {
		      this.modelId = this.request('model_id');
		      this.getModelList();
        },
        methods: {
	    	select_model:function(event){
	    		this.getCategoryList(event);
	    	},
	    	getModelList:function(){
	    		var _that = this;
	    		$ajax(
		            '/admin/model/get-model-list',
		            '', 
		            'post',
		            function(res){
		              _that.modelList = res.data;
		              _that.loading = false;
		            },
		            function(res){
		              _that.loading = true;
		            }
		        );
	    	},
	    	getCategoryList:function(m_id){
	    		var _that = this;
	    		$ajax(
		            '/admin/category/get-category-list',
		            {model_id:m_id},
		            'get',
		            function(res){
		              _that.categoryList = res.data;
		              _that.loading = false;
		            },
		            function(res){
		              _that.loading = true;
		            }
		        );
	    	},
	        addCategory:function(name){
	            var _that = this;
	            this.$refs[name].validate((valid) => {
	                if (valid) {
	                  _that.loading = true;
	                 $ajax(
	                    '/admin/category/add-category', 
	                    _that.categoryInfo, 
	                    'post',
	                    function(res){
	                        _that.$Message.success({
	                           content:'添加成功',
	                           onClose:function(){
	                            location.href = res.url;
	                           }
	                        });
	                    },
	                    function(res){
	                      _that.loading = false;
	                      _that.$Message.error('添加失败;'+res.message);
	                    },
	                  );
	                }
	            })
	          },
	      	//获取url参数
    			request: function (name, url) {
    				url = url || window.location.search;
    				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    				var r = url.substr(1).match(reg);
    				if (r != null) return (r[2]);
    				return '';
    			}
        }
    })
</script>



</body>
</html>