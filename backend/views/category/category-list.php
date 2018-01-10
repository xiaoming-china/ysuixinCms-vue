<!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">栏目列表</a>
      	</div>
      </div>
      <div class="card">
        <a class="a-basic-btn" href="/admin/category/add-category">
          <i class="icon-plus" style="color:#006699;"></i> 添加栏目
        </a>
      </div>
<!--       <div class="card">
        <div class="first-title">搜索</div>
            <div class="search-box">
                  <div>
                    <i-Input v-model="searchData.keyworlds" placeholder = "名称 / 标识 / 描述">
                    </i-Input>
                  </div>
                  <div>
                    <i-select v-model="searchData.status">
                        <i-option value="-1">全部</i-option>
                        <i-option value="1">开启</i-option>
                        <i-option value="0">禁用</i-option>
                    </i-select>
                  </div>
              <i-button @click="getCategoryList();">搜索</i-button>
            </div>
      </div> -->
      <!--模型列表-->
      <div class="card">
		<table class="table table72 table-striped">
			<thead>
				<tr>
	        <th style="width: 20px;">
	          <Checkbox v-model="check_all"></Checkbox>
	        </th> 
					<th style="width: 440px;text-align: left;padding-left: 40px;">名称</th>
					<th style="width: 80px;">所属模型</th>
          <th style="width: 40px;">栏目类型</th>
			    <th style="width: 110px;">操作</th>
				</tr>
			</thead> 
			<tbody>
			  <tr v-if="categoryList.length == 0">
			    <td colspan="8">
			      <p class="t-center">暂无数据</p>
			    </td>
			  </tr>
				<tr v-for="(value,key) in categoryList" :key="key" v-else>
			    <td><Checkbox v-model="check_all":value="value.catid"></Checkbox></td> 
					<td v-html = "value.html + value.catname" style="text-align: left;padding-left: 40px;"></td> 
					<td>{{value.model_name}}</td>
          <td>
            <span v-if = "value.type == 1" >内部栏目</span>
            <span v-if = "value.type == 2" >单页面</span>
          </td>
			        <td>
			          <span>
                   <a href="#"@click="location(2,value.catid,'');">编辑栏目</a>
                   &nbsp;&nbsp;|&nbsp;&nbsp;
                </span>
			          <span>
                   <a href="#"@click="deleteCategory(key,value.catid);">删除栏目</a>
                   <!-- &nbsp;&nbsp;|&nbsp;&nbsp; -->
                </span>
<!-- 			          <span>
			            <a href="#" v-if="value.type == 1" @click="location(1,value.catid,value.modelid);">
                  查看内容&nbsp;&nbsp;|&nbsp;&nbsp;
                  </a>
			          </span>
                <span>
                  <a href="#" v-if="value.type == 1"  @click="location(3,value.catid,value.modelid);">发布内容</a>
                  <a href="#" v-if="value.type == 2"  @click="location(3,value.catid,value.modelid);">编辑单页</a>
                </span> -->
			        </td>
				</tr>
			</tbody>
		</table>
      </div>
      <!--字段列表-->
    </div>

<script>
    new Vue({
        el: '#app',
        data:{
          loading:false,
          categoryList:[],
          searchData:{
            keyworlds:'',
            status:'-1',
          },
          check_all:false,
        },
        mounted: function() {
          this.getCategoryList();
        },
        methods: {
          //更改栏目状态
          changeStatusCategory:function(id,type,key) {
            //2禁用1开启;开启 or 禁用弹窗
            var _that = this;
            var title = type == 1 ? '开启' : '禁用';
            var info = '';
			info += '确定禁用此栏目？</br>';
			info += '注意：</br>1)、禁用会将栏目的子级全部禁用;</br>';
			info += '2)、如果此栏目或子级栏目有数据，将不能禁用;';
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
                    '/admin/field/change-field-status', 
                    params, 
                    'post',
                    function(res){
                      _that.$Message.success(title+'成功');
                      _that.$Modal.remove();
                      _that.fieldList[key].status = type == 1 ? 1 : 2;
                    },
                    function(res){
                      _that.$Message.warning(title+'失败;'+res.info);
                    },
                  );
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });
          },
          //删除栏目
          deleteCategory:function(key,id){
            var _that = this;
          	var info = '';
      			info += '确定删除此栏目？</br>';
      			info += '注意：</br>1)、删除栏目会将栏目的子级全部删除;</br>';
      			info += '2)、如果此栏目或子级栏目有数据，将不能删除;';
            this.$Modal.confirm({
                title:'删除确认',
                width:400,
                loading:true,
                content:info,
                onOk: () => {
                  _that.loading = true;
                  var params = {
                    'id':id
                  };
                  $ajax(
                    '/admin/category/del-category', 
                    params,
                    'post',
                    function(res){
                      _that.$Message.success('删除成功');
                      _that.$Modal.remove();
                      _that.getCategoryList();
                    },
                    function(res){
                      _that.$Message.warning('删除失败;'+res.info);
                    },
                  );
                  _that.loading = false;
                },
                onCancel: () => {
                  this.$Modal.remove();
                }
            });

          },
          //获取栏目列表
          getCategoryList:function(){
            var _that = this;
            $ajax(
              '/admin/category/category-list',
              _that.searchData, 
              'post',
              function(res){
                _that.categoryList = res.data;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          //跳转字段管理
          location:function(type,categoryId,modelId){
          	var url = '';
          	switch(type){
          	  case 1:
                url = '/admin/content/list?catid='+categoryId+'&modelid='+modelId;
          		break;
          	  case 2:
                url = '/admin/category/edit-category?catid='+categoryId;
          		break;
              case 3:
                url = '/admin/content/add-content?catid='+categoryId+'&modelid='+modelId;
              break;
          	}
            location.href = url;
            //window.open(url);
          },
          	//获取url参数
    			request: function (name, url) {
    				url = url || window.location.search;
    				var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    				var r = url.substr(1).match(reg);
    				if (r != null) return (r[2]);
    				return '';
    			},
        }
    })
</script>



</body>
</html>