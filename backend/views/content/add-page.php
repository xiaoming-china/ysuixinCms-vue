<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-编辑单页</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/public/admin/ueditor/themes/default/css/ueditor.css" type="text/css">

    <style>
	   body{
  	    background: rgb(238, 238, 238);
  	   }
        .ivu-input-wrapper,.ivu-select{
          display: table !important; 
          width: 98% !important;
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
            padding-left: 50px;
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
              padding: 0 0 20px 0;
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
        .left-card{
        	width: 77%;
        	background: #fff;
        	margin-right: 10px;
        	/*padding-top: 30px;*/
        	float: left;
          margin-bottom: 50px;
        }
  	  .right-card{
  	  	width: 21%;
  	  	float: right;
  	  	margin-right: 20px;
  	  }
  	  .right-card > div{
  	  	margin-bottom: 20px;
  	  }
  	  .right-card > div .seeting{
  	  	padding: 10px 0px 10px 0px;
  	  	display: inline-flex !important;
  	  }
      .demo-upload-list{
          display: inline-block;
          width: 60px;
          height: 60px;
          text-align: center;
          line-height: 60px;
          border: 1px solid transparent;
          border-radius: 4px;
          overflow: hidden;
          background: #fff;
          position: relative;
          box-shadow: 0 1px 1px rgba(0,0,0,.2);
          margin-right: 4px;
      }
      .demo-upload-list img{
          width: 100%;
          height: 100%;
      }
      .demo-upload-list-cover{
          display: none;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          background: rgba(0,0,0,.6);
      }
      .demo-upload-list:hover .demo-upload-list-cover{
          display: block;
      }
      .demo-upload-list-cover i{
          color: #fff;
          font-size: 20px;
          cursor: pointer;
          margin: 0 2px;
      }
  </style>
</head>
<body>
  <div class="main-content" style="margin-bottom: 100px;">
    <!--主体内容区开始-->
    <div class="" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">编辑单页</a>
      	</div>
      </div>
      <div class="card" style="padding-bottom: 30px;">
		    <Card>
      		  <i-Form ref="contentInfo"
                label-position="left"
                :model="contentInfo"
                :label-width="200">
                <Form-Item>
                    <span slot="label">
                      <span class="field-title" v-bind:class="'requird'">标题</span>
                      <p>最多50个字符</p>
                    </span>
    	              <i-Input type="text" size="large" 
                      v-model="contentInfo.title" 
                      style="width: 96% !important; ">
                    </i-Input>
    	          </Form-Item>
                <Form-Item>
                  <span slot="label">
                    <span class="field-title" v-bind:class="'requird'">内容</span>
                  </span>
                    <script id="content" type="text/plain" 
                    style="position: sticky !important;line-height: 0px !important;width: 98%; ">
                      <span v-model="contentInfo.content"></span>
                    </script>
                </Form-Item>
              </i-Form>
            </Card>
      </div>
	    <div class="btn_wrap_pd" style="left: 0;text-align: center;">
	        <i-Button type="primary"
	        @click="addContent()"
	        :loading="loading">
	          <span v-if="!loading">发布</span>
	          <span v-else>Loading...</span>
	        </i-Button>
	    </div>
    </div>
    <!--主体内容区结束-->

  </div>

  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="http://vuejs.org/js/vue.min.js"></script>
  <script src="http://unpkg.com/iview/dist/iview.min.js"></script>
  <script src="/public/admin/ueditor/ueditor.config.js"></script>
  <script src="/public/admin/ueditor/ueditor.all.min.js"> </script>
  <script src="/public/admin/js/main.js"></script>
  <script src="/public/admin/js/menu.js"></script>


<script>
    new Vue({
        el: '#app',
        data:{
          loading:false,
          contentInfo:{
            modelId:'',
            catId:'',
            title:'',
            content:''
          }
        },
        mounted: function() {
            this.contentInfo.catId   = this.request('catid');
            this.contentInfo.modelId = this.request('modelid');
            this.getPageContent();
            this.$nextTick(function () {
              UE.getEditor('content');
            });
        },
        methods: {
          //发布内容
          addContent:function(type){
            var _that = this;
            _that.contentInfo.content = UE.getEditor('content').getContent();
            if(!_that.contentValidate()){
                return false;
            }
              $ajax(
                  '/admin/content/add-page',
                  _that.contentInfo,
                  'post',
                  function(res){
                    var url = '/admin/category/category-list';
                      _that.$Message.success({
                          content:'发布成功',
                          onClose:function(){
                              location.href= url;
                          }
                      });
                  },
                  function(res){
                    _that.$Message.error(res.message);
                  },
                  true
              );
          },
          //获取内容
          getPageContent:function(type){
            var _that = this;
            $ajax(
                '/admin/content/get-page-content',
                {catId:this.contentInfo.catId},
                'get',
                function(res){
                  _that.contentInfo.title   = res.data.title;
                  _that.contentInfo.content = res.data.content;
                  UE.getEditor('content').addListener("ready", function () {
                    UE.getEditor('content').setContent(res.data.content,true);
                  });
                },
                function(res){
                  _that.$Message.error('单页数据获取失败');
                },
                false
            );
          },
          contentValidate:function(){
            var _that = this;
            if(_that.contentInfo.title.length <= 0){
              _that.$Message.warning('标题不能为空');
              return false;
            }
            if(_that.contentInfo.title.length > 50){
              _that.$Message.warning('标题最多50个字符');
              return false;
            }
            if(_that.contentInfo.content.length <= 0){
              _that.$Message.warning('单页内容不能为空');
              return false;
            }
            return true;
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