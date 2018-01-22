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
            margin-bottom: 20px !important;
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
			<a href="" class="crumbs">编辑栏目</a>
      	</div>
      </div>
      <!--添加栏目-->
      <div class="card" style="padding-bottom: 30px;">
	          <i-Form ref="categoryInfo" :model="categoryInfo"
                                    :rules="categoryInfoInfoline"
                                    label-position="left"
                                    :label-width="200">
                <Form-Item label="名称" prop="catname">
                    <span slot="label">
                      <span class="field-title">栏目名称</span>
                      <p>中英文；最多10个字符；如企业简介</p>
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
                      <p>栏目所属的模型；用于生成数据字段</p>
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
                <Form-Item label="名称" prop="description">
                    <span slot="label">
                      <span class="field-title">栏目描述</span>
                      <p>最多30个字符；</p>
                    </span>
                        <i-Input v-model="categoryInfo.description" 
	                      size="small" 
	                      type="textarea"
	                      :autosize="{minRows: 5,maxRows: 15}">
                </Form-Item>
                <Form-Item label="名称" prop="image">
                    <span slot="label">
                      <span class="field-title">栏目缩略图</span>
                    </span>
    	              <i-Input type="text" v-model="categoryInfo.image"></i-Input>
    	        </Form-Item>
    	        <Form-Item label="名称" prop="url">
                    <span slot="label">
                      <span class="field-title">链接地址</span>
                      <p class="field-title">不为空则点击栏目跳转到此地址</p>
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
                <div class="btn_wrap_pd">
                    <i-Button type="primary"
                    @click="editCategory('categoryInfo')"
                    :loading="loading"
                    style="width:92px;">
                      <span v-if="!loading">确定</span>
                      <span v-else>Loading...</span>
                    </i-Button>
                </div>
	          </i-Form>
      </div>
      <!--添加栏目-->
    </div>
    <!--主体内容区结束-->

<script>
    new Vue({
        el: '#app',
        data:function(){
        	return {
              categoryInfo: {
              	catid:'',
  	            catname: '',
  	            type:1,
  	            modelid: '',
  	            parentid:"0",
  	            description: '',
  	            image: '',
  	            url: '',
  	            ismenu: 1
              },
              modelList:[],
              categoryList:[],
              loading:false,
              categoryInfoInfoline: {
                catname: [
                    { required: true, message:'栏目名称不能为空',trigger:'blur'},
                    { max: 10, message:'栏目名称不能大于10个字符',trigger:'blur'}
                ],
                modelid: [
                    { required: true, message:'请选择所属模型',trigger:'blur'},
                ],
                parentid: [
                    { required: true, message:'请选择所属父级',trigger:'blur'}
                ],
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
		      var catid = this.categoryInfo.catid = this.request('catId');
		      this.getModelList();
		      this.getCategoryInfo(catid);
        },
        methods: {
	    	select_model:function(event){
	    		if(event != ''){
            this.getCategoryList(event);
          }
	    	},
	    	getCategoryInfo:function(cat_id){
	    		var _that = this;
	    		$ajax(
		            '/admin/category/get-category-info',
		            {catId:cat_id}, 
		            'get',
		            function(res){
		              _that.categoryInfo = res.data;
		              _that.loading = false;
		            },
		            function(res){
		              _that.loading = true;
		            }
		        );
	    	},
	    	getModelList:function(){
	    		var _that = this;
	    		$ajax(
		            '/admin/model/get-model-list',
		            '', 
		            'post',
		            function(res){
		              _that.modelList = res.data;
		            },
		            function(res){
		              _that.$Message.error('获取模型数据失败;');
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
		              _that.loading = false;
		            },
		            function(res){
		              _that.loading = true;
		            }
		        );
	    	},
	        editCategory:function(name){
	            var _that = this;
	            this.$refs[name].validate((valid) => {
	                if (valid) {
	                  _that.loading = true;
	                 $ajax(
	                    '/admin/category/edit-category', 
	                    _that.categoryInfo, 
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