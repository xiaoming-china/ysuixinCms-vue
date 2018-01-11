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
        <Tab-Pane label="高级配置" name="2">
            
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
        @click="config('fieldInfo')"
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
              loading:false,
              button:1,
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
            }
        },
        mounted: function() {
          var _that = this;
          _that.getConfig();
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
                  for(var i in data) {
                      if(Object.prototype.hasOwnProperty.call(data,i)) { 
                          if(basic[i] != undefined){
                            basic[i] = data[i];
                          }
                      }
                  }
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
            }
        }
    })
</script>



</body>
</html>