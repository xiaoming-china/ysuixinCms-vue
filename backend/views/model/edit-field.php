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
    <!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">编辑字段</a>
      	</div>
      </div>
      <!--添加字段-->
      <div class="card" style="padding-bottom: 30px;">
	          <i-Form ref="fieldInfo" :model="fieldInfo"
                                    :rules="fieldInfoline"
                                    label-position="left"
                                    :label-width="200">
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
                    @click="editField('fieldInfo')"
                    :loading="loading"
                    style="width:92px;"
                    :disabled="disabled"
                    >
                      <span v-if="!loading">确定</span>
                      <span v-else>Loading...</span>
                    </i-Button>
                </div>
	          </i-Form>
      </div>
      <!--添加字段-->

    <!--主体内容区结束-->


<script>
    new Vue({
        el: '#app',
        data:function(){
        	return {
        	    modelId:'',
              fieldId:'',
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
              disabled:false,
              change_select_type:false,
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
          this.fieldId = this.request('field_id');
          this.getFieldInfo();
        },
        methods: {
          select_type:function(event){
            var _that = this;
            //将对象里面元素全部设为false,再将当前选择的设为true
            for(var key in this.configParamsShow){
              this.configParamsShow[key] = false;
            }
            this.configParamsShow[event] = true;
            if(!this.change_select_type){
                if(event == 'select'){
                  this.configParams['default_value'] = '选项名称1|选项值1|默认选中true';
                }else{
                  this.configParams['default_value'] = '';
                }
                if(event == 'text'){
                  this.configParams['type']   = 'text';
                  this.configParams['width']  = '140';
                  this.configParams['height'] = '40';
                }
                if(event == 'select'){
                  this.configParams['type'] = 'radio';
                }
                if(event == 'date'){
                  this.configParams['type']          = 'dateAndTime';
                  this.configParams['default_value'] = 1;
                }
                if(event == 'pic_upload'){
                  this.configParams['allow_format'] = 'gif|jpg|jpeg|png|bmp';
                  this.configParams['width']        = '140';
                  this.configParams['height']       = '140';
                }
                if(event == 'file_upload'){
                  this.configParams['allow_format']  = 'txt|pdf|xls|doc|rar';
                }
            }
          },
          getFieldInfo(){
            var _that = this;
            $ajax(
              '/admin/field/get-field-info', 
              {'field_id':_that.fieldId}, 
              'get',
              function(res){
                _that.configParamsShow[res.data.type] = true;
                _that.change_select_type              = true;
                _that.fieldInfo                       = res.data;
                _that.configParams                    = res.data.seetings;

              },
              function(res){
                _that.disabled = true;
                _that.$Message.error({
                    content: '字段数据异常，不能编辑;',
                    duration: 0
                });
              },
            );
          },
          editField:function(name){
            var _that = this;
            this.$refs[name].validate((valid) => {
                if (valid) {
                  // _that.loading = true;
                  var params = {
                      modelId:_that.modelId,
                      fieldId:_that.fieldId,
                      fieldInfo: _that.fieldInfo,
                      configParams: _that.configParams,
                  };
                 $ajax(
                    '/admin/field/edit-field', 
                    params, 
                    'post',
                    function(res){
                      _that.$Message.success({
                         content:'编辑成功',
                         onClose:function(){
                          location.href = res.url;
                         }
                      });
                    },
                    function(res){
                      _that.loading = false;
                      _that.$Message.error('编辑失败;'+res.message);
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