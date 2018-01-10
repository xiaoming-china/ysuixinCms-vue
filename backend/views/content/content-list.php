<!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak style="padding-top: 44px;">
      <div class="card">
        <div class="zTree-list-box" v-if="categoryList.length =0">暂无栏目，请先添加栏目</div>
        <div class="zTree-list-box"  else>
          <ul id="treeDemo" class="ztree"></ul>
        </div>
      </div>
      <div class="content-list-box">
        <div class="card" style="margin: 10px 0 20px 10px;">
        	<div class="first-title">
      			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
      			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
      			<a href="" class="crumbs">内容管理</a>
        	</div>
        </div>
        <div class="card">
          <a class="a-basic-btn" href="#" @click="location(1);">
            <i class="icon-plus" style="color:#006699;"></i> 发布内容
          </a>
        </div>
        <div class="card">
          <div class="first-title">搜索</div>
              <div class="search-box">
                    <div>
                      <i-Input v-model="searchData.keyworlds" placeholder = "标题 / 关键字 / 简介">
                      </i-Input>
                    </div>
                    <div>
                    	<Date-Picker type="datetimerange" placeholder="发布时间" style="width: 100%;" v-on:on-change="selectTime"></Date-Picker>
                    </div>
                    <div>
                      <i-select v-model="searchData.status">
                          <i-option value="-1">全部</i-option>
                          <i-option value="1">已发布</i-option>
                          <i-option value="2">等待发布</i-option>
                          <i-option value="3">存为草稿</i-option>
                          <i-option value="4">待审核</i-option>
                      </i-select>
                    </div>
                <i-button @click="getContentList();">搜索</i-button>
              </div>
        </div>
        <!--模型列表-->
        <div class="card">
  		<table class="table table72 table-striped">
  			<thead>
  				<tr>
  			        <th style="width: 40px;">
  			          <input type='checkbox'
                                 :checked="isCheckedAll"
                                 @click='checkedAll()'>
                          &nbsp;&nbsp;
  			        </th>  
  					<th style="width: 250px;text-align:left;padding-left:30px;">标题</th> 
  					<th style="width: 50px;">点击量</th> 
  					<th style="width: 50px;">作者</th> 
  					<th style="width: 50px;">状态</th>
  			    <th style="width: 50px;">发布时间</th>
  			    <th style="width: 118px;">操作</th>
  				</tr>
  			</thead> 
  			<tbody>
  			    <tr v-if="contentList.length == 0">
  			          <td colspan="8">
  			              <p class="t-center">暂无数据</p>
  			          </td>
  			    </tr>
  				<tr v-for="(value,key) in contentList" :key="key" v-else>
  			        <td>
  			        	<input type='checkbox'
                                 :disabled = "value.is_style == 1"
                                 :style="{cursor: value.is_style == 1 ? 'no-drop' : ''}"
                                 :checked  = "allData.indexOf(value.id)>=0"
                                 @click    = "checkedOne(value.id)">
                                 {{key + 1}}
  			        </td> 
  					<td style="text-align:left;padding-left:30px;">
  					  {{value.title}}
  					</td> 
  					<td>{{value.view}}</td> 
  					<td>{{value.create_by}}</td> 
  					<td>
  						<span v-if="value.status == 1">已发布</span>
              <span v-if="value.status == 2">等待发布</span>
  						<span v-if="value.status == 3">存为草稿</span>
              <span v-if="value.status == 4">待审核</span>
  					</td> 
  					<td>
              <span v-if="value.status == 1">{{getLocalTime(value.publish_time)}}</span>
              <span v-if="value.status == 2">{{getLocalTime(value.publish_time)}}</span>
              <span v-if="value.status == 3">存为草稿</span>
              <span v-if="value.status == 4">待审核</span>
            </td>
  			        <td v-if="value.is_style != 1">
  			          <span><a href="#"@click="location(2,value.id);">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
  			          <span><a href="#"@click="deleteContent(value.id);">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
  <!--                 <span><a href="#"@click="location(3,value.id);">查看评论</a>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
  			          <span>
  			            <a href="#" v-if="value.status == 1" @click="changeStatusField(value.id,2,key);">禁用</a>&nbsp;&nbsp;|&nbsp;&nbsp;
  			            <a href="#" v-else @click="changeStatusField(value.id,1,key);">开启</a>&nbsp;&nbsp;|&nbsp;&nbsp;
  			          </span> -->
  			        </td> 
  			        <td v-if="value.is_style == 1">
  			          系统字段，暂不可操作
  			        </td> 
  				</tr>
  			</tbody>
  		</table>
            <Page :total="searchData.total" show-sizer show-elevator show-total
            v-on:on-change="pageChange"
            v-on:on-page-size-change="sizeChange">
            </Page>
        </div>
        <!--字段列表-->
  	    <div class="btn_wrap_pd" style="left: 300px;">
            <i-Button type="primary"
                        @click="checkedAll()"
                        :loading="loading">
                <span v-if="isCheckedAll">取消全选</span>
                <span v-else>全选</span>
            </i-Button>
  	        <i-Button type="primary"
  	        @click="addField('fieldInfo')"
  	        :loading="loading">
  	          <span v-if="!loading">批量审核</span>
  	          <span v-else>Loading...</span>
  	        </i-Button>
  	        <i-Button type="primary"
  	        @click="addField('fieldInfo')"
  	        :loading="loading">
  	          <span v-if="!loading">取消审核</span>
  	          <span v-else>Loading...</span>
  	        </i-Button>
  	        <i-Button type="primary"
  	        @click="addField('fieldInfo')"
  	        :loading="loading">
  	          <span v-if="!loading">批量推送</span>
  	          <span v-else>Loading...</span>
  	        </i-Button>
  	        <i-Button type="primary"
  	        @click="addField('fieldInfo')"
  	        :loading="loading">
  	          <span v-if="!loading">批量移动</span>
  	          <span v-else>Loading...</span>
  	        </i-Button>
  	        <i-Button type="primary"
  	        @click="alldeleteContent()">
  	          <span>批量删除</span>
  	        </i-Button>
  	    </div>
      </div>
    </div>
    <!--主体内容区结束-->

  </div>


<script>
    new Vue({
        el: '#app',
        data:{
          modelId:'',
          catId:'',
          loading:false,
          isCheckedAll: false,
          allData:[],
          contentList:[],
          categoryList: [],
          searchData:{
            modelId:'',
            catId:'',
            keyworlds:'',
            status:'-1',
            start_time:'',
			      end_time:'',
            total:0,
            page:0,
            pageSize:20
          },
          check_all:false,
        },
        mounted: function() {
    		  this.modelId = this.request('modelid');
    		  this.catId   = this.request('catid');
          this.searchData.modelId = this.request('modelid');
          this.searchData.catId   = this.request('catid');
          this.getContentList();
          this.getTreeData();
        },
        methods: {
          checkedOne (id) {
                var idIndex = this.allData.indexOf(id)
                if (idIndex >= 0) {
                    this.allData.splice(idIndex, 1);
                } else {
                    this.allData.push(id);
                }
            },
            checkedAll:function () {
                this.isCheckedAll = !this.isCheckedAll;
                if (this.isCheckedAll) {
                    this.allData = [];
                    var length =  this.contentList.length;
                    for(var i = 0;i < length;i++){
                      this.allData.push(this.contentList[i]['id']);
                    }
                } else {
                    this.allData = []
                }
           },
        //去往第几页
          pageChange: function(page){
              this.searchData.page = page;
              this.getContentList();
          },
          //每页显示几条
          sizeChange: function(size){
              this.searchData.pageSize = size;
              this.getContentList();
          },
          selectTime:function(time){
          	var data = time.toString().split(",");
			this.searchData.start_time = data[0];
			this.searchData.end_time   = data[1];
          },
          //批量删除
          alldeleteContent:function () {
                var data = this.allData;
                if(data.length <= 0){
                    this.$Message.warning('请选择数据');
                    return;
                }
                this.deleteContent(data);
            },
          //删除内容
          deleteContent:function(id){
            var _that = this;
            _that.allData.push(id);
            this.$Modal.confirm({
                title:'删除确认',
                width:300,
                loading:true,
                content:'<p>是否删除?</p>',
                onOk: () => {
                  _that.loading = true;
                  var params = {
                    'id':_that.allData,
                    'modelid':_that.modelId
                  };
                  $ajax(
                    '/admin/content/del-content', 
                    params,
                    'post',
                    function(res){
                      _that.$Message.success('删除成功');
                      _that.$Modal.remove();
                      _that.getContentList();
                    },
                    function(res){
                      _that.$Message.warning(res.info);
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
          getContentList:function(){
            var _that = this;
            $ajax(
              '/admin/content/list',
              {
              	modelId:_that.modelId,
              	catId:_that.catId,
              	param:_that.searchData,
              },
              'get',
              function(res){
                _that.contentList = res.data.list;
                _that.searchData.total = res.data.count;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          getTreeData:function(tree){
                var _that = this;
                $ajax(
                    '/admin/content/index',
                    '', 
                    'post',
                    function(res){
                    //配置
                      var setting = {
                          data: {
                              key: {
                                  name: "name"
                              },
                              simpleData: {
                                  enable: true,
                                  idKey: "catid",
                                  pIdKey: "parentid",
                              }
                          },
                          callback: {
                              beforeClick: function (treeId, treeNode) {
                                  if (treeNode.isParent) {
                                      zTree.expandNode(treeNode);
                                      return false;
                                  } else {
                                      return true;
                                  }
                              },
                          onClick:function(event, treeId, treeNode){
                            //栏目ID
                            var catid = treeNode.catid;
                            //保存当前点击的栏目ID
                            // setCookie('tree_catid',catid,1);
                          }
                          }
                      };
                          var zTree = null;
                          $.fn.zTree.init($("#treeDemo"), setting, res.data);
                          zTree = $.fn.zTree.getZTreeObj("treeDemo");
                          $("#ztree_expandAll").click(function(){
                            if($(this).data("open")){
                              zTree.expandAll(false);
                              $(this).data("open",false);
                            }else{
                              zTree.expandAll(true);
                              $(this).data("open",true);
                            }
                          });
                          //定位到上次打开的栏目，进行展开tree_catid
                          // var tree_catid = getCookie('tree_catid');
                          // if(tree_catid){
                          //   var nodes = zTree.getNodesByParam("catid", tree_catid, null);
                          //   zTree.selectNode(nodes[0]);
                          // }
                      _that.categoryList = res.data;
                    },
                    function(res){}
                );
            },
          location:function(type,id){
          	var url = '';
          	switch(type){
          	  case 1:url = '/admin/content/add-content?modelid='+this.modelId+'&catid='+this.catId;
          		break;
          	  case 2:url = '/admin/content/edit-content?modelid='+this.modelId+'&catid='+this.catId+'&id='+id;
          		break;
              case 3:url = '/admin/comment/comment-list?id='+id+'&catid='+this.catId;
              break;
          	}
            location.href = url;
          },
          //格式化时间戳
          getLocalTime:function(nows) {
            if(nows == "" || nows == null){
                return  "";
            }else{
                var now  = new Date(parseInt(nows)*1000);
                var year=now.getFullYear();
                var month=now.getMonth()+1;
                var date=now.getDate();
                var hour=now.getHours().toLocaleString().split("").length == 1 ?"0"+now.getHours():now.getHours();
                var minute=now.getMinutes().toLocaleString().split("").length == 1 ?"0"+now.getMinutes():now.getMinutes();
                var second=now.getSeconds().toLocaleString().split("").length == 1 ?"0"+now.getSeconds():now.getSeconds();
                return year+"-"+month+"-"+date+"  "+hour+":"+minute+":"+second;
            }
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