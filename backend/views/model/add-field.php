<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-添加字段</title>
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
			<a href="" class="crumbs">添加字段</a>
      	</div>
      </div>
      <!--添加字段-->
      <div class="card" style="padding-bottom: 30px;">
	          <i-Form ref="fieldInfo" :model="fieldInfo"
                                    :rules="fieldInfoline"
                                    label-position="left"
                                    :label-width="300">
                <Form-Item label="名称" prop="name">
                    <span slot="label">
                      <span class="field-title">名称</span>
                      <p>中英文；最多10个字符；如:名称</p>
                    </span>
    	              <i-Input type="text" v-model="fieldInfo.name"></i-Input>
    	          </Form-Item>
                <Form-Item prop="name_desc">
                    <span slot="label">
                      <span class="field-title">名称提示</span>
                      <p>用于字段填写描述;</p>
                      <p>最多30个字符;如:此字段不能为空</p>
                    </span>
                    <i-Input type="textarea" v-model="fieldInfo.name_desc"></i-Input>
                </Form-Item>
                <Form-Item prop="e_name">
                    <span slot="label"><span class="field-title">别名</span>
                      <p>最多20个字符,只能为英文;如:name</p>
                    </span>
                    <i-Input type="text" v-model="fieldInfo.e_name"></i-Input>
                </Form-Item>
                <Form-Item label="字段类型" prop="type">
                    <span slot="label"><span class="field-title">字段类型</span>
                      <p>需要添加字段的类型；如：选择文本框，则会生成文本框的字段</p>
                    </span>
                    <i-select v-model="fieldInfo.type" v-on:on-change="select_type">
                        <i-option value="">请选择字段类型</i-option>
                        <i-option value="text">单行文本框</i-option>
                        <i-option value="textarea">多行文本框</i-option>
                        <i-option value="select">选择框</i-option>
                        <i-option value="date">日期时间选择框</i-option>
                        <i-option value="pic_upload">图片上传</i-option>
                        <i-option value="file_upload">文件上传</i-option>
                        <i-option value="editor">富文本编辑器</i-option>
                    </i-select>
                </Form-Item>
                <!--以下为每个选项的参数设置-->
                <!--text-->
                <Form-Item label="相关参数" v-if="configParamsShow.text">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">默认值</th>
                            <th id="field-params">
                              <i-Input type="text" size="small" v-model="configParams.default_value"></i-Input>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">文本框宽 * 高</th>
                            <th id="field-params">
                              <Input-Number :max="255" :min="1" v-model="configParams.width" style="width:70px !important;float:left;"size="small"></Input-Number>
                              <span style="float:left;padding:0 10px 0 10px;">-</span> 
                              <Input-Number :max="255" :min="1" v-model="configParams.height" style="width:70px !important;float:left;"size="small"></Input-Number>&nbsp;&nbsp;px
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">文本框类型</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.type">
                                <Radio label="text">文本框</Radio>
                                <Radio label="password">密码框</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">值长度范围</th>
                            <th id="field-params">
                              <Input-Number :max="255" :min="1" v-model="configParams.min_length" style="width:50px !important;float:left;"size="small"></Input-Number>
                              <span style="float:left;padding:0 10px 0 10px;">-</span> 
                              <Input-Number :max="255" :min="1" v-model="configParams.max_length" style="width:50px !important;float:left;"size="small"></Input-Number>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--text-->
                <!--textarea-->
                <Form-Item label="相关参数" v-if="configParamsShow.textarea">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">默认值</th>
                            <th id="field-params">
                               <i-Input v-model="configParams.default_value" size="small" type="textarea" :autosize="{minRows: 2,maxRows: 7}"></i-Input>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">文本框宽 * 高</th>
                            <th id="field-params">
                              <Input-Number :max="255" :min="1" v-model="configParams.width" style="width:70px !important;float:left;"size="small"></Input-Number>
                              <span style="float:left;padding:0 10px 0 10px;">-</span> 
                              <Input-Number :max="255" :min="1" v-model="configParams.height" style="width:70px !important;float:left;"size="small"></Input-Number>&nbsp;&nbsp;px
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">值长度范围</th>
                            <th id="field-params">
                              <Input-Number :max="255" :min="1" v-model="configParams.min_length" style="width:70px !important;float:left;"size="small"></Input-Number>
                              <span style="float:left;padding:0 10px 0 10px;">-</span> 
                              <Input-Number :min="1" v-model="configParams.max_length" style="width:70px !important;float:left;"size="small"></Input-Number>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--textarea-->
                <!--select-->
                <Form-Item label="相关参数" v-if="configParamsShow.select">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p>选项值格式：选项名称|选项值|true。true表示当前选项为默认选项;</p>
                      <p>多个请使用Enter换行</p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">选项值</th>
                            <th id="field-params">
                              <i-Input v-model="configParams.default_value" 
                              size="small" 
                              type="textarea" 
                              :autosize="{minRows: 5,maxRows: 15}">
                            </i-Input>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">选择框类型</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.type">
                                <Radio label="radio">单选框</Radio>
                                <Radio label="checkbox">多选框</Radio>
                                <Radio label="select">下拉框</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--select-->
                <!--date-->
                <Form-Item label="相关参数" v-if="configParamsShow.date">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">时间格式</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.type">
                                <Radio label="date">日期</Radio>
                                <Radio label="time">时间</Radio>
                                <Radio label="dateAndTime">日期+时间</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">默认值</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.default_value">
                                <Radio label="1">无</Radio>
                                <Radio label="2">当前日期时间</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--date-->
                <!--pic_upload-->
                <Form-Item label="相关参数" v-if="configParamsShow.pic_upload">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">默认值</th>
                            <th id="field-params">
                               <i-Input v-model="configParams.default_value" size="small" type="input" :autosize="{minRows: 2,maxRows: 7}"></i-Input>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">是否多图</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.many_select">
                                <Radio label="true">是</Radio>
                                <Radio label="false">否</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">允许上传格式</th>
                            <th id="field-params">
                               <i-Input v-model="configParams.allow_format" size="small" type="input" :autosize="{minRows: 2,maxRows: 7}"></i-Input>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">是否添加水印</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.watermark">
                                <Radio label="true">是</Radio>
                                <Radio label="false">否</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">自动裁剪范围</th>
                            <th id="field-params">
                              <Input-Number :min="140" v-model="configParams.width" style="width:70px !important;float:left;"size="small"></Input-Number>
                              <span style="float:left;padding:0 10px 0 10px;">-</span> 
                              <Input-Number :min="140" v-model="configParams.height" style="width:70px !important;float:left;"size="small"></Input-Number>&nbsp;px
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--pic_upload-->
                <!--file_upload-->
                <Form-Item label="相关参数" v-if="configParamsShow.file_upload">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">是否多文件</th>
                            <th id="field-params">
                              <Radio-Group v-model="configParams.many_select">
                                <Radio label="true">是</Radio>
                                <Radio label="false">否</Radio>
                              </Radio-Group>
                            </th>
                          </tr>
                          <tr>
                            <th style="width:80px;">允许上传格式</th>
                            <th id="field-params">
                               <i-Input v-model="configParams.allow_format" size="small" type="input" :autosize="{minRows: 2,maxRows: 7}"></i-Input>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--file_upload-->
                <!--editor-->
                <Form-Item label="相关参数" v-if="configParamsShow.editor">
                  <span slot="label"><span class="field-title">相关参数</span>
                      <p></p>
                  </span>
                    <table class="field-params-table">
                        <tbody>
                          <tr>
                            <th style="width:80px;">默认值</th>
                            <th id="field-params">
                              <i-Input type="textarea"  v-model="configParams.default_value"></i-Input>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                </Form-Item>
                <!--editor-->
                <!--以上为每个选项的参数设置-->
                <Form-Item label="是否必填" prop="not_null">
                  <span slot="label">
                    <span class="field-title">是否必填</span>
                  </span>
                  <Radio-Group v-model="fieldInfo.not_null">
                      <Radio label="1">是</Radio>
                      <Radio label="2">否</Radio>
                  </Radio-Group>
                </Form-Item>
                <Form-Item label="是否隐藏" prop="is_hide">
                    <span slot="label">
                      <span class="field-title">是否隐藏</span>
                      <p>建议如果字段是隐藏域，设置为隐藏;如:浏览数等不需要展示的字段</p>
                    </span>
                  <Radio-Group v-model="fieldInfo.is_hide">
                      <Radio label="1">是</Radio>
                      <Radio label="2">否</Radio>
                  </Radio-Group>
                </Form-Item>
                <Form-Item label="名称" prop="regular">
                    <span slot="label">
                      <span class="field-title">正则验证</span>
                      <p>正则验证数据的合法性；如：正则验证数字为^[0-9]*$</p>
                    </span>
                    <i-Input type="text" v-model="fieldInfo.regular" ></i-Input>
                </Form-Item>
                <Form-Item label="名称" prop="not_null_info">
                    <span slot="label">
                      <span class="field-title">必填提示信息</span>
                      <p>如果字段为必填时，用户未填写信息出现的提示。最多15个字符</p>
                    </span>
                    <i-Input type="text" v-model="fieldInfo.not_null_info"></i-Input>
                </Form-Item>
                <Form-Item label="名称" prop="error_info">
                    <span slot="label">
                      <span class="field-title">错误提示信息</span>
                      <p>如果字段为填写出错时出现的提示。如：格式不符合。最多15个字符</p>
                    </span>
                    <i-Input type="text" v-model="fieldInfo.error_info"></i-Input>
                </Form-Item>
                <div class="btn_wrap_pd">
                    <i-Button type="primary"
                    @click="addField('fieldInfo')"
                    :loading="loading"
                    style="width:92px;">
                      <span v-if="!loading">确定</span>
                      <span v-else>Loading...</span>
                    </i-Button>
                </div>
	          </i-Form>
      </div>
      <!--添加字段-->
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
        	    modelId:'',
              fieldInfo: {
  	            name: '',
  	            name_desc: '',
  	            e_name:'',
  	            type: '',
  	            not_null: 1,
  	            is_hide: 2,
  	            regular: '',
  	            not_null_info:'',
  	            error_info:''
              },
              configParamsShow:{
                 text:false,
                 textarea:false,
                 select:false,
                 date:false,
                 pic_upload:false,
                 file_upload:false,
                 editor:false
              },
              configParams:{
                watermark:'false',
                many_select:'false',
                default_value:'',
                type:'text',
                min_length:1,
                max_length:255,
                width:'',
                height:'',
                allow_format:''
              },
              loading:false,
              fieldInfoline: {
                name: [
                    { required: true, message:'名称不能为空',trigger:'blur'},
                    { max: 10, message:'名称不能大于10个字符',trigger:'blur'}
                ],
                e_name: [
                    { required: true, message:'别名不能为空',trigger:'blur'},
                    { max: 10, message:'别名不能大于10个字符',trigger:'blur'},
                    { pattern: '^[A-Za-z]+$', message:'别名只能是英文字符',trigger:'blur'}
                ],
                type: [
                    { required: true, message:'请选择字段类型',trigger:'blur'}
                ],
                name_desc:[          
                    { max: 30, message:'名称描述不能大于50个字符',trigger:'blur'}
                ],
                not_null_info:[          
                    { max: 15, message:'必填提示信息不能大于15个字符',trigger:'blur'}
                ],
                error_info:[          
                    { max: 15, message:'错误提示信息不能大于15个字符',trigger:'blur'}
                ]
              },
            }
        },
        mounted: function() {
		      this.modelId = this.request('model_id');
        },
        methods: {
          select_type:function(event){
            var _that = this;
            //将对象里面元素全部设为false,再将当前选择的设为true
            for(var key in this.configParamsShow){
              this.configParamsShow[key] = false;
            }
            this.configParamsShow[event] = true;
            if(event == 'select'){
              this.configParams['default_value'] = '选项名称1|选项值1|默认选中true';
            }else{
              this.configParams['default_value'] = '';
            }
            if(event == 'text'){
              this.configParams['type'] = 'text';
              this.configParams['width']   = '140';
              this.configParams['height']  = '40';
            }
            if(event == 'select'){
              this.configParams['type'] = 'radio';
            }
            if(event == 'date'){
              this.configParams['type']          = 'dateAndTime';
              this.configParams['default_value'] = 1;
            }
            if(event == 'pic_upload'){
              this.configParams['allow_format']  = 'gif|jpg|jpeg|png|bmp';
              this.configParams['width']   = '140';
              this.configParams['height']  = '140';
            }
            if(event == 'file_upload'){
              this.configParams['allow_format']  = 'txt|pdf|xls|doc|rar';
            }
          },
          addField:function(name){
            var _that = this;
            this.$refs[name].validate((valid) => {
                if (valid) {
                  _that.loading = true;
                  var params = {
                      modelId:_that.modelId,
                      fieldInfo: _that.fieldInfo,
                      configParams: _that.configParams,
                  };
                 $ajax(
                    '/admin/field/add-field', 
                    params, 
                    'post',
                    function(res){
                      _that.$Modal.confirm({
                          title: '提示',
                          content: '<p>添加成功,是否继续添加？</p>',
                          okText: '继续添加',
                          cancelText: '不需要',
                          onOk: () => {
                            location.reload();
                          },
                          onCancel: () => {
                            location.href = res.url;
                          }
                      });
                      _that.loading = false;
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