<!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">内容 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">评论管理</a>
      	</div>
      </div>
      <div class="card">
        <div class="first-title">搜索</div>
            <div class="search-box">
                  <div>
                    <i-Input v-model="searchData.keyworlds" placeholder = "关键字">
                    </i-Input>
                  </div>
                  <div>
                  	<Date-Picker type="datetimerange" placeholder="评论时间" style="width: 100%;" v-on:on-change="selectTime"></Date-Picker>
                  </div>
                  <div>
                  </div>
              <i-button @click="getComment();">搜索</i-button>
            </div>
      </div>
      <!--模型列表-->
      <div class="card">
		<table class="table table72 table-striped">
			<thead>
				<tr>
		        <th style="width: 40px;">编号</th>  
				<th style="width: 50px;">评论者</th> 
				<th style="width: 200px;">评论内容</th> 
				<th style="width: 200px;">回复内容</th> 
				<th style="width: 50px;">状态</th>
			    <th style="width: 80px;">评论时间</th>
			    <th style="width: 80px;">回复时间</th>
			    <th style="width: 100px;">操作</th>
				</tr>
			</thead> 
			<tbody>
			    <tr v-if="commentList.length == 0">
			          <td colspan="8">
			              <p class="t-center">暂无数据</p>
			          </td>
			    </tr>
				<tr v-for="(value,key) in commentList" :key="key" v-else>
			        <td>{{key + 1}}</td> 
					<td>{{value.title}}</td> 
					<td>{{value.view}}</td> 
					<td>{{value.create_by}}</td> 
					<td>
						<span v-if="value.status == 1">已展示</span>
            			<span v-if="value.status == 2">已隐藏</span>
					</td> 
					<td>
			            <span v-if="value.status == 1">{{getLocalTime(value.comment_at)}}</span>
			            <span v-if="value.status == 2">{{getLocalTime(value.re_at)}}</span>
			        </td>
			        <td>
			          <span>
			          	<a href="#"@click="location(2,value.id);">查看</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			          </span>
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
    </div>
    <!--主体内容区结束-->

  </div>


<script>
    new Vue({
        el: '#app',
        data:{
          commentList:[],
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
        },
        mounted: function() {
          this.getComment();
        },
        methods: {
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
          getComment:function(){
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
                _that.commentList = res.data.list;
                _that.searchData.total = res.data.count;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          location:function(type,id){
          	var url = '';
          	switch(type){
          	  case 1:url = '/admin/content/add-content?modelid='+this.modelId+'&catid='+this.catId;
          		break;
          	  case 2:url = '/admin/content/edit-content?modelid='+this.modelId+'&catid='+this.catId+'&id='+id;
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