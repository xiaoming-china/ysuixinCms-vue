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
          padding-bottom: 20px;
      }
      .ivu-form-item-content {
            margin-left: 165px !important;
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
      .ivu-upload-drag,.ivu-upload-drag:hover{
        border: none;
      }
      .upload-text{
        width: 18% !important;
        float: left;
        margin-right: 12px;
      }
      .upload-button{
        width: 49px;
        height: 31px;
        line-height: 31px;
        cursor: pointer;
        border-radius: 4px;
      }
    </style>
<div class="right-content" id="app" v-cloak>
  <div class="card">
      <!--1s-->
      <Tabs value="1" v-on:on-click="tabs_change">
        <Tab-Pane label="基本配置" name="1">
            <i-Form ref="basicInline" 
                label-position="left" 
                :model="basicInline" 
                :rules="basicRules"
                :label-width="150">
              <Form-Item label="名称" prop="sitename">
                  <span slot="label">
                    <span class="field-title">站点名称</span>
                    <p>最多30个字符；</p>
                    <p>如:意随心内容管理系统</p>
                  </span>
                  <i-Input type="text" v-model="basicInline.sitename" :maxlength=30></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="sitekeywords">
                  <span slot="label">
                    <span class="field-title">站点关键字</span>
                    <p>最多80个字符；</p>
                    <p>多个请用,号隔开</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.sitekeywords" :rows="2" :maxlength=80></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="siteinfo">
                  <span slot="label">
                    <span class="field-title">站点简介</span>
                    <p>最多300个字符；</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.siteinfo" :rows="3" :maxlength=300></i-Input>
              </Form-Item>

              <Form-Item label="名称" prop="sietopen">
                  <span slot="label">
                    <span class="field-title">开启站点</span>
                  </span>
                  <Radio-Group v-model="basicInline.sietopen">
                    <Radio label="1">开启</Radio>
                    <Radio label="2">关闭</Radio>
                  </Radio-Group>
              </Form-Item>
              <Form-Item label="名称" prop="closememo" v-if="basicInline.sietopen == 2">
                  <span slot="label">
                    <span class="field-title">关闭原因</span>
                    <p>最多300个字符；</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.closememo" :maxlength=300 :rows="3"></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="sitecontacts">
                  <span slot="label">
                    <span class="field-title">站点联系人</span>
                    <p>最多15个字符；如:意随心</p>
                  </span>
                  <i-Input type="text" v-model="basicInline.sitecontacts" :maxlength=15></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="contactsmail">
                  <span slot="label">
                    <span class="field-title">联系人邮箱</span>
                  </span>
                  <i-Input type="text" v-model="basicInline.contactsmail"></i-Input>
              </Form-Item>
            </i-Form>
        </Tab-Pane>
        <!--1s-->
        <!--2s-->
        <Tab-Pane label="附件配置" name="2">
            <i-Form ref="fileInline" 
                label-position="left" 
                :model="fileInline" 
                :rules="fileRules"
                :label-width="150">
              <Form-Item label="名称" prop="uploadmaxsize">
                  <span slot="label">
                    <span class="field-title">允许上传附件大小</span>
                    <p>单位：kb</p>
                  </span>
                  <i-Input type="text" v-model="fileInline.uploadmaxsize"></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="uploadallowext">
                  <span slot="label">
                    <span class="field-title">允许上传附件类型</span>
                    <p>多个请用&nbsp;|&nbsp;隔开</p>
                  </span>
                  <i-Input type="text" v-model="fileInline.uploadallowext"></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="watermarkenable">
                  <span slot="label">
                    <span class="field-title">是否开启图片水印</span>
                    <p>最多300个字符；</p>
                  </span>
                  <Radio-Group v-model="fileInline.watermarkenable">
                    <Radio label="1">开启</Radio>
                    <Radio label="2">关闭</Radio>
                  </Radio-Group>
              </Form-Item>
              <Form-Item label="名称" prop="watermarkimg">
                  <span slot="label">
                    <span class="field-title">水印图片</span>
                  </span>
                  <template>
                    <i-Input type="text" v-model="fileInline.watermarkimg" class="upload-text" 
                    @on-click="handleView()" icon="search" title="点击图标预览">
                    </i-Input>
                    <Upload
                        ref="upload"
                        :show-upload-list="false"
                        :on-success="handleSuccess"
                        :format="['jpg','jpeg','png']"
                        type="drag"
                        name="File"
                        action="/admin/upload/upload"
                        style="display: inline-block;width:58px;">
                        <i-Button>上传</i-Button>
                    </Upload>
                    <Modal title="View Image" v-model="visible">
                        <img :src="imgUrl" v-if="visible" style="width: 100%">
                    </Modal>
                </template>
              </Form-Item>
              <Form-Item label="名称" prop="watermarkpct">
                  <span slot="label">
                    <span class="field-title">水印透明度</span>
                    <p>最多15个字符；如:意随心</p>
                  </span>
                  <i-Input type="text" v-model="fileInline.watermarkpct"></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="watermarkpos">
                  <span slot="label">
                    <span class="field-title">水印位置</span>
                  </span>
                  <i-Select v-model="fileInline.watermarkpos" transfer="true" style="width:200px">
                    <i-Option value="1">左上角</i-Option>
                    <i-Option value="2">上居中</i-Option>
                    <i-Option value="3">右上角</i-Option>
                    <i-Option value="4">左居中</i-Option>
                    <i-Option value="5">居中</i-Option>
                    <i-Option value="6">右居中</i-Option>
                    <i-Option value="7">左下角</i-Option>
                    <i-Option value="8">下居中</i-Option>
                    <i-Option value="9">右下角</i-Option>
                  </i-Select>
              </Form-Item>
            </i-Form>
        </Tab-Pane>
        <!--2s-->
        
      </Tabs>
      <div class="btn_wrap_pd">
        <i-Button type="primary"
        @click="configBasic('basicInline')"
        :loading="loading"
        style="width:92px;" v-if="button == 1">
          <span v-if="!loading">确定</span>
          <span v-else>Loading...</span>
        </i-Button>
        <i-Button type="primary"
        @click="configFile('fileInline')"
        :loading="loading"
        style="width:92px;" v-if="button == 2">
          <span v-if="!loading">确定</span>
          <span v-else>Loading...</span>
        </i-Button>
      </div>
  </div>
</div>
<!--主体内容区结束-->

<script>
    new Vue({
        el: '#app',
        data:function(){
            return {
              basicInline: {
                  sitename:'',
                  sitekeywords:'',
                  siteinfo:'',
                  sietopen:1,
                  closememo:'',
                  sitecontacts:'',
                  contactsmail:'',
              },
              fileInline:{
                uploadmaxsize:2024,
                uploadallowext:'',
                watermarkenable:1,
                watermarkimg:'',
                watermarkpct:80,
                watermarkpos:'5'
              },
              loading:false,
              button:1,
              imgUrl: '/public/admin/img/logo.png',
              visible: false,
              uploadList: [],
              basicRules: {
                sitename: [
                    { maxlength:30, message: '最多30个字符', trigger:'blur'}
                ],
                sitekeywords: [
                    { maxlength:80, message: '最多80个字符', trigger:'blur'}
                ],
                siteinfo: [
                    { maxlength:300, message: '最多300个字符', trigger:'blur'}
                ],
                closememo: [
                    { maxlength:300, message: '最多300个字符', trigger:'blur'}
                ],
                sitecontacts: [
                    { maxlength:15, message: '最多15个字符', trigger:'blur'}
                ],
                contactsmail: [
                    { type: 'email', message: '邮箱格式不正确', trigger:'blur'}
                ],
              },
              fileRules: {
                uploadmaxsize:[
                    {pattern :"^[0-9]*$", message: '只能为数字', trigger:'blur'}
                ],
                watermarkpct: [
                    {pattern :"^[0-9]*$", min:0,max:100, message: '范围只能为0~100', trigger:'blur'},
                    {pattern :"^[0-9]*$", message: '只能为数字', trigger:'blur'}
                ],
              }
            }
        },
        mounted: function() {
          var _that = this;
          _that.getConfig();
          _that.uploadList = this.$refs.upload.fileList;
        },
        methods: {
          tabs_change:function(tab_value){
            this.button = tab_value;
          },
          getConfig:function(){
            var _that = this;
              $ajax(
                '/admin/config/get-config', 
                '', 
                'post',
                function(res){
                  var data  = res.data;
                  var basic = _that.basicInline;
                  var file  = _that.fileInline;
                  for(var i in data) {
                      if(Object.prototype.hasOwnProperty.call(data,i)) { 
                          if(basic[i] != undefined){
                            basic[i] = data[i];
                          }
                          if(file[i] != undefined){
                            file[i]  = data[i];
                          }
                      }
                  }
                  console.log(file);
                },
                function(res){
                  _that.$Message.warning('配置信息获取失败');
                }
              );
          },
          configBasic:function(name) {
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading = true;
                    $ajax(
                      '/admin/config/basic', 
                      _that.basicInline, 
                      'post',
                      function(res){
                        _that.$Message.success('操作成功');
                        _that.loading = false;
                      },
                      function(res){
                        _that.$Message.warning(res.message);
                        _that.loading = false;
                      }
                    );
                }
              })
            },
            configFile:function(name) {
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading = true;
                    $ajax(
                      '/admin/config/basic', 
                      _that.fileInline, 
                      'post',
                      function(res){
                        _that.$Message.success('操作成功');
                        _that.loading = false;
                      },
                      function(res){
                        _that.$Message.warning(res.message);
                        _that.loading = false;
                      }
                    );
                }
              })
            },
            handleView () {
                this.visible = true;
            },
            handleSuccess (res, file) {
              var img_path = res.data.base_url+'/'+res.data.path+'/'+res.data.name;
              this.fileInline.watermarkimg = img_path;
              this.imgUrl = img_path;
              
            }
        }
    })
</script>



</body>
</html>