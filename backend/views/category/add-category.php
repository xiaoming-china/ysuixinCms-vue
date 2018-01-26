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
            /*margin-left: 165px !important;*/
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
    <i-Form ref="categoryInfo" :model="categoryInfo"
              :rules="categoryInfoInfoline"
              label-position="left"
              :label-width="200">
          <!--1s-->
          <Tabs :value=tab_value v-on:on-click="tabs_change">
            <Tab-Pane label="基本信息" name="1">
              <Form-Item label="名称" prop="catname">
                    <span slot="label">
                      <span class="field-title">栏目名称</span>
                      <p>中英文；最多10个字符；</p>
                      <p>如企业简介</p>
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
                      <p>栏目所属的模型；</p>
                      <p>用于生成数据字段</p>
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
                          <span v-html="value.html + value.catname"></span>
                        </i-option>
                    </i-select>
                </Form-Item>
                <Form-Item label="名称" prop="image">
                  <span slot="label">
                    <span class="field-title">栏目缩略图</span>
                  </span>
                  <template>
                    <i-Input type="text" disabled v-model="imgUrl" class="upload-text" 
                    @on-click="handleView()" icon="search" title="图片预览">
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
                    <Modal title="图片预览" v-model="visible">
                        <img :src="imgUrl" style="width: 100%" v-if="imgUrl != ''">
                    </Modal>
                </template>
              </Form-Item>
              <Form-Item label="名称" prop="url">
                    <span slot="label">
                      <span class="field-title">链接地址</span>
                      <p>不为空则点击栏目跳转到此地址</p>
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
            </Tab-Pane>
            <!--1s-->
            <!--2s-->
            <Tab-Pane label="SEO信息" name="2">
                <Form-Item label="名称" prop="categoryInfo.setting.category_keywords">
                    <span slot="label">
                      <span class="field-title">栏目关键字</span>
                      <p>多个请用,号隔开;</p>
                      <p>最多50个字符</p>
                    </span>
                    <i-Input type="text" v-model="categoryInfo.setting.category_keywords"></i-Input>
                </Form-Item>
                <Form-Item label="名称" prop="categoryInfo.setting.category_desc">
                    <span slot="label">
                      <span class="field-title">栏目描述</span>
                      <p>最多200个字符</p>
                    </span>
                        <i-Input v-model="categoryInfo.setting.category_desc" 
                        size="small" 
                        type="textarea"
                        :autosize="{minRows: 5,maxRows: 15}">
                </Form-Item>
            </Tab-Pane>
              <!--2s-->
          </Tabs>
       </i-Form>
      <div class="btn_wrap_pd">
        <i-Button type="primary"
          @click="addCategory('categoryInfo')"
          style="width:92px;">确定</i-Button>
      </div>
  </div>
</div>
<!--主体内容区结束-->

<script>
    new Vue({
        el: '#app',
        data:function(){
          return {
              categoryInfo: {
                catname: '',
                type:"1",
                modelid: '',
                parentid:"0",
                image: '',
                url: '',
                ismenu: 1,
                setting:{
                  category_keywords:'',
                  category_desc:''
                }
              },
              tab_value:"1",
              imgUrl: '',
              visible: false,
              uploadList: [],
              modelList:[],
              categoryList:[],
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
          this.getModelList();
          this.uploadList = this.$refs.upload.fileList;
        },
        methods: {
          tabs_change:function(tab_value){
            this.tab_value = tab_value;
          },
        select_model:function(event){
          if(event != ''){
            this.getCategoryList(event);
          }
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
                {modelId:m_id},
                'get',
                function(res){
                  _that.categoryList = res.data;
                },
                function(res){
                  _that.$Message.error('获取模型数据失败;');
                }
            );
        },
          addCategory:function(name){
              var _that = this;
              this.$refs[name].validate((valid) => {
                  if (valid) {
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
                        _that.$Message.error('添加失败;'+res.message);
                      },
                    );
                  }else{
                    if(_that.tab_value == "2"){
                        _that.tab_value = "1";
                    }
                  }
              })
            },
            handleView () {
                this.visible = true;
            },
            handleSuccess (res, file) {
              var img_path = res.data.base_url+'/'+res.data.path+'/'+res.data.name;
              this.categoryInfo.image = img_path;
              this.imgUrl = img_path;
            }
        }
    })
</script>


</body>
</html>