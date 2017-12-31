<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-发布内容</title>
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
			<a href="" class="crumbs">发布内容</a>
      	</div>
      </div>
      <!--模型列表-->
      <div class="card" style="padding-bottom: 30px;">
      	<div class="left-card">
      	  <Col span="11">
		    <Card>
      		  <i-Form ref="modelFieldList"
                label-position="left"
                :model="modelFieldList"
                :label-width="200">
                <Form-Item :label="item.name" 
                :prop="item.e_name"
                v-for="(item, index) in modelFieldList">
                    <span slot="label">
                      <span class="field-title" 
                      v-bind:class="[item.not_null == 1 ? 'requird' : '']">
                        {{item.name}}
                      </span>
                      <p v-if="item.name_desc != ''">{{item.name_desc}}</p>
                    </span>
    	              <i-Input type="text" size="large" v-model="item.value" v-if="item.type == 'text'">
    	              </i-Input>
    	              <i-Input type="textarea" v-model="item.value" size="large" v-if="item.type == 'textarea'">
    	              </i-Input>
    	               <checkbox-Group v-model="item.value" v-if="item.type == 'select' && item.seetings.type == 'checkbox'">
        				        <checkbox v-for="(v,k) in item.seetings.default_value" :label="v.value">
        				         {{v.name}}
        				        </checkbox>
            				  </checkbox-Group>
				              <Radio-Group v-if="item.type == 'select' && item.seetings.type == 'radio'" v-model="item.value">
                         <Radio v-for="(v,k) in item.seetings.default_value" :label="v.value">{{v.name}}
                         </Radio>
                      </Radio-Group>
                      <!--日期选择器-->
                      <Date-Picker type="date" :value="item.value" format="yyyy-MM-dd" v-if="item.type == 'date' && item.seetings.type == 'date'" @on-change="contentInfo[item.e_name]=$event">
                      </Date-Picker>
  					  <!--日期选择器-->
          					  <!--日期时间选择器-->
          					  <Date-Picker type="datetime" :value="item.value" format="yyyy-MM-dd HH:mm:ss" v-if="item.type == 'date' && item.seetings.type == 'dateAndTime'"@on-change="contentInfo[item.e_name]=$event" >
                          </Date-Picker>
              				<!--日期时间选择器-->
                      <!--上传图片-->
                      <div v-if="item.type == 'pic_upload'">
                        <div class="demo-upload-list" v-if="item.value != ''"
                        v-for="(p_item, p_key) in item.value ">
                          <img v-bind:src='p_item' style="vertical-align: top;"> 
                          <div class="demo-upload-list-cover">
                          <Icon type="ios-eye-outline" @click.native="handleView(item.e_name,index,p_key)"></Icon>
                          <Icon type="ios-trash-outline" @click.native="handleRemove(item.e_name,index,p_key)"></Icon>
                          </div>
                        </div>
                        <div :id="'upload_'+item.e_name"  class="ivu-upload" style="display: inline-block; width: 58px;" @click="openFile(item.e_name);">
                          <div class="ivu-upload ivu-upload-drag">
                              <span v-if="item.seetings.many_select === 'false'">
                                  <input type="file"
                                 class="ivu-upload-input upload"
                                 :id="item.e_name"
                                 @change="getFile($event,index,item.e_name,item.seetings.many_select)">
                              </span>
                              <span else>
                                  <input type="file"
                                  class="ivu-upload-input upload"
                                  multiple = "multiple"
                                  :id="item.e_name"
                                  @change="getFile($event,index,item.e_name,item.seetings.many_select)">
                              </span>
                            <div style="width: 58px; height: 58px; line-height: 58px;">
                             <i class="ivu-icon ivu-icon-camera" style="font-size: 20px;"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--上传图片-->
                      <!--编辑器-->
                      <div v-if="item.type == 'editor'" style="position: sticky !important;line-height: 0px !important; ">
                        <script :id="item.e_name" type="text/plain">
                            {{item.value}}
                        </script>
                      </div>
                      <!--编辑器-->
    	          </Form-Item>
              </i-Form>
            </Card>
		  </Col>
      	</div>
            	<div class="right-card">
            		<div>
            			<Col span="11">
      		            <Card>
      		                <p slot="title">
      		                	<Icon type="gear-a"></Icon> 
      		                	发布设置
      		                </p>
      		                <p class="seeting">状　　态：
      		                	<i-select size="small" v-model="contentInfo.status" style="width:100px !important;">
      		                      <i-option value="1">发布</i-option>
      		                      <i-option value="2">待审核</i-option>
      		                    </i-select>
      		                </p>
      		                <p class="seeting">发布时间：
      		                	<Date-Picker type="datetime" format="yyyy-MM-dd HH:mm:ss" :value="contentInfo.publish_time" style="width:200px !important;" size="small" @on-change="contentInfo.publish_time=$event" >
      		                	</Date-Picker>
      		                </p>
      		                <p>允许评论：
      		                	<Radio-Group v-model="contentInfo.allow_comment">
                                <Radio label="1">允许</Radio>
                                <Radio label="2">不允许</Radio>
                            </Radio-Group>
      		                </p>
      		            </Card>
      		        </Col>
            		</div>
            		<div>
            			<Col span="11">
      		            <Card>
      		                <p slot="title">
      		                	<Icon type="navicon-round"></Icon> 
      		                	发布栏目
      		                </p>
      		                <p>
      		                	<Tree :data="categoryList" show-checkbox v-on:on-check-change = "getTreeData" empty-text = "分类栏目为空,请先去添加栏目">
                            </Tree>
      		                </p>
      		            </Card>
      		        </Col>
            		</div>
            		<div>
            			<Col span="11">
      		            <Card>
      		                <p slot="title">
      		                	<Icon type="ios-book-outline"></Icon> 
      		                	模板设置
      		                </p>
      		                <p>
      		                	<i-select v-model="contentInfo.show_template">
      		                      <i-option value="show.php">show.php</i-option>
      		                      <i-option value="show_a.php">show_a.php</i-option>
      		                      <i-option value="show_b.php">show_b.php</i-option>
      		                      <i-option value="show_c.php">show_c.php</i-option>
      		                  </i-select>
      		                </p>
      		            </Card>
      		        </Col>
            		</div>
            	</div>
          
      </div>
      <!--字段列表-->
	    <div class="btn_wrap_pd" style="left: 0;text-align: center;">
	        <i-Button type="primary"
	        @click="addContent('1')"
	        :loading="loading">
	          <span v-if="!loading">发布</span>
	          <span v-else>Loading...</span>
	        </i-Button>
	        <i-Button type="primary"
	        @click="addContent('2')"
	        :loading="loading">
	          <span v-if="!loading">保存草稿</span>
	          <span v-else>Loading...</span>
	        </i-Button>
	    </div>
        <Modal title="图片预览" v-model="visible">
            <img :src=imgUrl v-if="visible" style="width: 100%"/>
        </Modal>
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
          modelId:'',
          catId:'',
          loading:false,
          modelFieldList:{},
          categoryList: [],
          imgUrl: '',
          visible: false,
          contentInfo:{
            modelId:'',
            catId:'',
            status:"1",
            publish_time:'',
            allow_comment:1,
            category_id:[],
            show_template:'show.php'
          }
        },
        mounted: function() {
            this.modelId = this.request('modelid');
            this.catId   = this.request('catid');
            // this.contentInfo.catId   = this.request('catid');
            this.contentInfo.modelId = this.request('modelid');
            this.contentInfo.publish_time = this.getNowTime();
            this.getModelField();
        },
        methods: {
          //上传图片
          openFile:function(obj){
            $('#'+obj).click();
          },
          getFile(e,key,obj,is_many) {
              var _that = this;
              var file = e.target.files;
              var formData = new FormData();
              var length = file.length;
              for (var i = 0; i < length; i++) {
                formData.append('File', file[i],file[i].name);
                $.ajax({
                    type:'post',
                    url:'/admin/upload/upload',
                    data:formData,
                    dataType: "json",
                    processData:false,
                    contentType: false,
                    success: function(res,textStatus,xhr){
                        if(res.status == 1){
                          var base_url = res.data.base_url;
                          var path = res.data.path;
                          var name = res.data.name;
                          var url  = base_url +'/'+path+'/'+name;
                          if(is_many === 'false'){
                            $('#upload_'+obj).hide();
                          }
                          _that.modelFieldList[key].value.push(url);
                        }else{
                          _that.$Message.warning(i+'张上传失败');
                          return;
                        }                  
                    }
                });
              }
          },
          //查看图片
          handleView:function(e_name,item_key,p_key){
            var _that = this;
            _that.imgUrl = _that.modelFieldList[item_key].value[p_key];
            _that.visible = true;
          },
          //删除图片
          handleRemove:function(e_name,item_key,p_key){
            var _that = this;
            _that.modelFieldList[item_key].value.splice(p_key,1);
            if(_that.modelFieldList[item_key].value.length == 0){
                $('#upload_'+e_name).show();
            }
          },
          //获取模型下所有栏目
          getTreeData:function(tree){
            var _that = this;
            _that.contentInfo.category_id = [];
            var length = tree.length;
            for (var i = 0; i < length; i++) {
              _that.contentInfo.category_id.push(tree[i].catid);
            }
          },
          //获取模型所有字段
          getModelField:function(){
            var _that = this;
            $ajax(
              '/admin/content/get-model-field',
              {
              	modelid:_that.modelId
              },
              'get',
              function(res){
                _that.modelFieldList = res.data.model_field;
                _that.categoryList   = res.data.all_category;
                //加载所有是富文本的字段编辑器
                _that.$nextTick(function () {
                    var length = res.data.model_field.length;
                    var data   = res.data.model_field;
                    for (var i = 0; i < length; i++) {
                        _that.contentInfo[data[i]['e_name']] = data[i]['value'];
                        if(data[i]['type'] === 'editor'){
                          UE.getEditor(data[i]['e_name']);
                        }
                    }
                });
              },
              function(res){
                _that.$Message.warning('添加内容数据获取失败');
              },
            );
          },
          //发布内容
          addContent:function(type){
            var _that = this;
            // var _that = this;
            var count = _that.modelFieldList.length;
            var data  = _that.modelFieldList;

            for (var i = 0; i < count; i++) {
              //获取编辑器内容填充到数组
              if(data[i]['type'] === 'editor'){
                data[i]['value'] =  UE.getEditor(data[i]['e_name']).getContent();
                _that.contentInfo[data[i]['e_name']] = UE.getEditor(data[i]['e_name']).getContent();
              }else{
                  _that.contentInfo[data[i]['e_name']] = data[i]['value'];
              }
            }
              $ajax(
                  '/admin/content/add-content',
                  {data : JSON.stringify(_that.contentInfo)},
                  'post',
                  function(res){
                    _that.$Message.success('发布成功');
                  },
                  function(res){
                    _that.$Message.error('发布失败,'+res.message);
                  },
                  false
              );
          },
          contentValidate:function(){
            var _that = this;
            var count = _that.modelFieldList.length;
            var data  = _that.modelFieldList;

            for (var i = 0; i < count; i++) {
              //非空验证
              if(data[i]['not_null'] == 1 && data[i]['value'] == ''){
                if(data[i]['not_null_info'] !== ''){
                  var not_null_info = data[i]['not_null_info'];
                }else{
                  var not_null_info = data[i]['name']+'不能为空';
                }
                _that.$Message.warning(not_null_info);
                return false;
              }
              //text类型验证
              if(data[i]['type'] === 'text' ||  data[i]['type'] === 'textarea'){
                if(data[i]['value'].length > data[i]['seetings']['max_length']){
                  _that.$Message.warning(data[i]['name']+'最多'+data[i]['seetings']['max_length']+'字符');
                  return false;
                }
                if(data[i]['value'].length < data[i]['seetings']['min_length']){
                  _that.$Message.warning(data[i]['name']+'最少'+data[i]['seetings']['min_length']+'字符');
                  return false;
                }
                //pic_upload类型验证
                if(data[i]['type'] === 'pic_upload'){
                  if(data[i]['value'].length > data[i]['seetings']['max_length']){
                    _that.$Message.warning(data[i]['name']+'最多'+data[i]['seetings']['max_length']+'张');
                    return false;
                  }
                }
              }
            }
            if(_that.contentInfo.category_tree.length <= 0){
              _that.$Message.warning('请选择发布栏目');
              return false;
            }
            return true;
          },
          location:function(type,catId){
          	var url = '';
          	switch(type){
          	  case 1:url = '/admin/content/add-content?modelid='+this.modelId+'&catid='+this.catId;
          		break;
          	  case 2:url = '/admin/field/edit-field?model_id='+this.modelId+'&field_id='+fieldId;
          		break;
          	}
            location.href = url;
          },
          getNowTime:function(nows) {
      		    var date = new Date();
      		    var seperator1 = "-";
      		    var seperator2 = ":";
      		    var month = date.getMonth() + 1;
      		    var strDate = date.getDate();
      		    if (month >= 1 && month <= 9) {
      		        month = "0" + month;
      		    }
      		    if (strDate >= 0 && strDate <= 9) {
      		        strDate = "0" + strDate;
      		    }
      		    var currentdate = date.getFullYear() + seperator1 + 
      			    month + seperator1 + strDate
      			    + " " + date.getHours() + seperator2 + 
      			    date.getMinutes()
      			    + seperator2 + 
      			    date.getSeconds();
      		    return currentdate;
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