<div class="right-content" id="app">
  <div class="card">
      <!--1s-->
      <Tabs value="1" v-on:on-click="tabs_change">
        <Tab-Pane label="基本配置" name="1">
          <i-Form ref="basicInline" label-position="left" 
            :model="basicInline" 
            :rules="basicrules"
            :label-width="200">
              <Form-Item label="名称" prop="name">
                  <span slot="label">
                    <span class="field-title">站点名称</span>
                    <p>最多30个字符；如:意随心内容管理系统</p>
                  </span>
                  <i-Input type="text" v-model="basicInline.site_name" :maxlength=30></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="name">
                  <span slot="label">
                    <span class="field-title">站点关键字</span>
                    <p>最多80个字符；</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.site_keywords" :rows="4" :maxlength=80></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="name">
                  <span slot="label">
                    <span class="field-title">站点简介</span>
                    <p>最多500个字符；</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.site_desc" :rows="4" :maxlength=500></i-Input>
              </Form-Item>

              <Form-Item label="名称" prop="site_open">
                  <span slot="label">
                    <span class="field-title">开启站点</span>
                  </span>
                  <Radio-Group v-model="basicInline.site_open">
                    <Radio label="1">开启</Radio>
                    <Radio label="2">关闭</Radio>
                  </Radio-Group>
              </Form-Item>
              <Form-Item label="名称" prop="site_open" v-if="basicInline.site_open == 2">
                  <span slot="label">
                    <span class="field-title">关闭原因</span>
                    <p>最多500个字符；</p>
                  </span>
                  <i-Input type="textarea" v-model="basicInline.close_memo" :maxlength=500 :rows="4"></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="name">
                  <span slot="label">
                    <span class="field-title">站点联系人</span>
                    <p>最多15个字符；如:意随心内容管理系统</p>
                  </span>
                  <i-Input type="text" v-model="basicInline.site_name" :maxlength=15></i-Input>
              </Form-Item>
              <Form-Item label="名称" prop="name">
                  <span slot="label">
                    <span class="field-title">联系人邮箱</span>
                  </span>
                  <i-Input type="text" v-model="basicInline.site_name"></i-Input>
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
        @click="config('fieldInfo')"
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
                  site_name: '',
                  user_email: '',
                  use_desc:'',
                  site_open:1,
                  close_memo:''
              },
              loading:false,
              button:1,
              basicrules: {
                user_name: [
                    { required: true, message: '账号不能为空', trigger:'blur'}
                ],
                user_email: [
                    { type: 'email', message: '邮箱格式不正确', trigger:'blur'}
                ],
              },
            }
        },
        mounted: function() {
          var _that = this;


        },
        methods: {
          tabs_change:function(tab_value){
            this.button = tab_value;
          },
            changeInfo:function(name) {
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading = true;
                    var params = new URLSearchParams();
                    params.append('user_email', _that.basicInline.user_email);
    				        params.append('desc', _that.basicInline.use_desc);
                    axios.post('/admin/person-info/person-info',params).then(function (res) {
                       if (res.data.status == 1) {
                           _that.$Message.success({
                              content:'修改成功',
                           });
                       }else{
                            _that.$Message.warning(res.data.message);
                       }
                      _that.loading = false;
                    }).catch(function (error) {
                        _that.$Message.error('请求失败,服务器错误');
                    });
                }
              })
            },
            handleReset:function(name) {
                this.$refs[name].resetFields();
            }
        }
    })
</script>



</body>
</html>