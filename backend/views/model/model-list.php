<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-模型列表</title>
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
    			<a href="" class="crumbs">模型列表</a>
      	</div>
      </div>
      <div class="card">
        <a class="a-basic-btn" href="#" @click="showAddModel=true;">
          <i class="icon-plus" style="color:#006699;"></i> 添加模型
        </a>
      </div>
      <div class="card">
        <div class="first-title">搜索</div>
            <div class="search-box">
                  <div>
                    <i-Input v-model="searchData.keyworlds" placeholder = "名称 / 别名 / 描述">
                    </i-Input>
                  </div>
                  <div>
                    <i-select v-model="searchData.status">
                        <i-option value="-1">全部</i-option>
                        <i-option value="1">开启</i-option>
                        <i-option value="0">禁用</i-option>
                    </i-select>
                  </div>
              <i-button @click="getModelList();">搜索</i-button>
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
    						<th style="width: 80px;">别名(数据表名)</th> 
    						<th style="width: 120px;">描述</th> 
    						<th style="width: 40px;">状态</th>
                <th style="width: 110px;">添加时间</th>
                <th style="width: 128px;">操作</th>
    					</tr>
    				</thead> 
    				<tbody>
              <tr v-if="modelList.length == 0">
                  <td colspan="8">
                      <p class="t-center">暂无数据</p>
                  </td>
              </tr>
    					<tr v-for="(value,key) in modelList" :key="key" v-else>
                <td><Checkbox v-model="check_all":value="value.id"></Checkbox></td> 
                <td>{{key + 1}}</td>
    						<td>{{value.name}}</td> 
    						<td>{{value.e_name}}</td> 
    						<td>{{value.desc}}</td> 
    						<td>
                  <p v-if="value.status == 1">√</p>
                  <p v-else>✘</p>
                </td> 
    						<td>{{getLocalTime(value.created_at)}}</td>
                <td>
                  <span><a href="#"@click="showEditModel(key);">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                  <span><a href="#"@click="deleteModel(key,value.id);">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                  <span>
                    <a href="#" v-if="value.status == 1" @click="changeStatusModel(value.id,2,key);">禁用</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href="#" v-else @click="changeStatusModel(value.id,1,key);">开启</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                  </span>
                  <span><a href="#" @click="location(value.id);">字段管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                </td> 
    					</tr>
    				</tbody>
    			</table>
          <Page :total="searchData.total" show-sizer show-elevator show-total
                  v-on:on-change="pageChange"
                  v-on:on-page-size-change="sizeChange">
          </Page>
      </div>
      <!--模型列表-->
      <Modal v-model="showAddModel">
        <p slot="header">
            <span>添加模型</span>
        </p>
        <i-Form ref="ModelInfo" :model="ModelInfo" :rules="modelrule">
            <Form-Item label="名称" prop="name">
                <i-Input type="text" 
                        v-model="ModelInfo.name" 
                        size="large" 
                        placeholder = "最多10个字符">
              </i-Input>
            </Form-Item>
            <Form-Item label="别名" prop="e_name">
                <i-Input type="text" 
                          v-model="ModelInfo.e_name" 
                          size="large"
                          placeholder = "最多10个字符 / 只能为英文">
                </i-Input>
            </Form-Item>
            <Form-Item label="描述" prop="desc">
                <i-Input type="textarea" 
                          v-model="ModelInfo.desc" 
                          size="large"
                          placeholder = "最多30个字符">
                        </i-Input>
            </Form-Item>
            <Form-Item label="状态">
                <Radio-Group v-model="ModelInfo.status">
                    <Radio label="1">开启</Radio>
                    <Radio label="2">禁用</Radio>
                </Radio-Group>
            </Form-Item>
        </i-Form>
        <br>
        <p slot="footer">
           <i-button type="primary" @click="addModel('ModelInfo')">
              <span v-if="!loading">确定</span>
              <span v-else>Loading...</span>
           </i-button>
           <i-button type="info" @click="showAddModel=false;">取消</i-button>
        </p>
      </Modal>
      <!--编辑模型-->
      <Modal v-model="editModel">
        <p slot="header">
            <span>编辑模型</span>
        </p>
        <i-Form ref="ModelInfo" :model="ModelInfo" :rules="modelrule">
            <Form-Item label="名称" prop="name">
                <i-Input type="text" 
                        v-model="ModelInfo.name" 
                        size="large" 
                        placeholder = "最多10个字符">
              </i-Input>
            </Form-Item>
            <Form-Item label="别名" prop="e_name">
                <i-Input type="text" 
                          v-model="ModelInfo.e_name" 
                          size="large"
                          placeholder = "最多10个字符 / 只能为英文">
                </i-Input>
            </Form-Item>
            <Form-Item label="描述" prop="desc">
                <i-Input type="textarea" 
                          v-model="ModelInfo.desc" 
                          size="large"
                          placeholder = "最多30个字符">
                        </i-Input>
            </Form-Item>
            <Form-Item label="状态">
                <Radio-Group v-model="ModelInfo.status">
                    <Radio label="1">开启</Radio>
                    <Radio label="2">禁用</Radio>
                </Radio-Group>
            </Form-Item>
        </i-Form>
        <br>
        <p slot="footer">
           <i-button type="primary" @click="editModelInfo('ModelInfo')">
              <span v-if="!loading">确定</span>
              <span v-else>Loading...</span>
           </i-button>
           <i-button type="info" @click="editModel=false;">取消</i-button>
        </p>
      </Modal>


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
          modelList:[],
          searchData:{
            keyworlds:'',
            status:'-1',
            total:0,
            page:0,
            pageSize:20
          },
          showAddModel:false,
          editModel:false,
          ModelInfo:{
            model_id:'',
            name:'',
            e_name:'',
            model_desc:'',
            status:1
          },
          check_all:false,
          modelrule:{
              name: [
                  {required: true, message: '名称不能为空', trigger:'blur'},
                  {max: 10,message: '名称不能大于10个字符', trigger:'blur'}
              ],
              e_name: [
                  {required: true,message: '别名不能为空', trigger:'blur'},
                  {max: 10,message: '别名不能大于10个字符', trigger:'blur'},
                  {pattern :"^[A-Za-z]+$",message: '别名只能是英文字符', trigger:'blur'}
              ],
              model_desc: [
                 {max: 30, message:'描述不能超过30个字符', trigger:'blur'}
              ],
          }
        },
        mounted: function() {
          this.getModelList();
        },
        methods: {
          //去往第几页
          pageChange: function(page){
              this.searchData.page = page;
              this.getModelList();
          },
          //每页显示几条
          sizeChange: function(size){
              this.searchData.pageSize = size;
              this.getModelList();
          },
          //更改模型状态
          changeStatusModel:function(id,type,key) {
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
                    '/admin/model/change-model-status', 
                    params, 
                    'post',
                    function(res){
                      _that.$Message.success(title+'成功');
                      _that.$Modal.remove();
                      _that.modelList[key].status = type == 1 ? 1 : 2;
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
          deleteModel:function(key,id){
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
                    '/admin/model/del-model', 
                    params,
                    'post',
                    function(res){
                      _that.$Message.success('删除成功');
                      _that.$Modal.remove();
                      _that.modelList.splice(key,1);
                      _that.searchData.total--;
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
          //获取模型列表
          getModelList:function(){
            var _that = this;
            $ajax(
              '/admin/model/model-list', 
              _that.searchData, 
              'get',
              function(res){
                _that.modelList = res.data.list;
                _that.searchData.total = res.data.count;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          //添加模型
          addModel:function(name){
              this.$refs[name].validate((valid) => {
                if (valid) {
                  var _that = this;
                  _that.loading = true;
                  var params = {
                      name: _that.ModelInfo.name,
                      e_name: _that.ModelInfo.e_name,
                      desc: _that.ModelInfo.desc,
                      status: _that.ModelInfo.status,
                  };
                  $ajax(
                    '/admin/model/add-model', 
                    params, 
                    'post',
                    function(res){
                      _that.$refs[name].resetFields();
                      _that.showAddModel = false;
                      _that.getModelList();
                    },
                    function(res){
                       _that.$Message.warning('添加失败;'+res.message);
                    },
                  );
                  _that.loading = false;
                }
              })
          },
          showEditModel:function(key){
            this.ModelInfo.model_id = this.modelList[key]['id'];
            this.ModelInfo.name   = this.modelList[key]['name'];
            this.ModelInfo.e_name = this.modelList[key]['e_name'];
            this.ModelInfo.desc   = this.modelList[key]['desc'];
            this.ModelInfo.status = this.modelList[key]['status'];
            this.editModel = true;
          },
          editModelInfo:function(name){
            this.$refs[name].validate((valid) => {
              if (valid) {
                var _that = this;
                _that.loading = true;
                $ajax(
                  '/admin/model/edit-model', 
                  _that.ModelInfo, 
                  'post',
                  function(res){
                    _that.$Message.success('编辑成功');
                    _that.$refs[name].resetFields();
                    _that.editModel = false;
                    _that.getModelList();
                  },
                  function(res){
                     _that.$Message.warning('编辑失败;'+res.message);
                  },
                );
                _that.loading = false;
              }
            })
          },
          //跳转字段管理
          location:function(modelId){
            location.href = '/admin/field/field-list?model_id='+modelId;
          },
          //格式化时间戳
          getLocalTime:function(nows) {//格式化时间
            if(nows == "" || nows == null){
                return  "";
            }else{
                var   now  = new Date(parseInt(nows)*1000);
                var   year=now.getFullYear();
                var   month=now.getMonth()+1;
                var   date=now.getDate();
                var   hour=now.getHours().toLocaleString().split("").length == 1 ?"0"+now.getHours():now.getHours();
                var   minute=now.getMinutes().toLocaleString().split("").length == 1 ?"0"+now.getMinutes():now.getMinutes();
                var   second=now.getSeconds().toLocaleString().split("").length == 1 ?"0"+now.getSeconds():now.getSeconds();
                return   year+"-"+month+"-"+date+"   "+hour+":"+minute+":"+second;
            }
          },
        }
    })
</script>



</body>
</html>