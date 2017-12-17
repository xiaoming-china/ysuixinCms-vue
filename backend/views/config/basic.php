<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-站点配置信息</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
    <script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
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
            margin-bottom: 15px !important;
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
  </div>
  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="/public/admin/js/main.js"></script>
  <script src="/public/admin/js/menu.js"></script>

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