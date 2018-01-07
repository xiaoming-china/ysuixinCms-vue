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
                    <i-Input v-model="searchData.keyworlds" placeholder = "评论内容 /  回复内容">
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
		        <th style="width: 120px;">所属内容</th>
		        <th style="width: 50px;">所属栏目</th>
				<th style="width: 50px;">评论者</th> 
				<!--<th style="width: 200px;">回复内容</th>  -->
				<th style="width: 50px;">状态</th>
			    <th style="width: 60px;">评论时间</th>
			    <th style="width: 60px;">回复时间</th>
			    <th style="width: 60px;">操作</th>
				</tr>
			</thead> 
			<tbody>
			    <tr v-if="commentTopList.length == 0">
			          <td colspan="8">
			              <p class="t-center">暂无数据</p>
			          </td>
			    </tr>
				<tr v-for="(value,key) in commentTopList" :key="key" v-else>
			        <td>{{key + 1}}</td> 
			        <td>
						<span :title="value.content_title">{{strLen(value.content_title,0,15)}}</span>
			        </td> 
			        <td>{{value.catname}}</td> 
					<td>{{value.commen_user}}</td> 
<!-- 					<td>{{strLen(value.comment_content,0,20)}}</td> 
					<td>
						<span v-if="value.re_content == ''">暂未回复</span>
            			<span else>{{strLen(value.re_content,0,20)}}</span>
					</td>  -->
					<td>
						<span v-if="value.status == 1">已展示</span>
            			<span v-if="value.status == 2">已隐藏</span>
					</td> 
					<td>{{getLocalTime(value.comment_at)}}</td>
			        <td>
						<span v-if="value.re_content == ''"></span>
            			<span else>{{getLocalTime(value.re_at)}}</span>
					</td> 
			        <td>
			          <span>
			          	<a href="#"@click="viewComment(value.id);">查看评论</a>
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
          <!--编辑模型-->
  <Modal v-model="commentModel" width="670" :mask-closable="false" >
    <p slot="header">
        <span>查看评论</span>
    </p>
    <ul class="comment-re-list">
		<li @click="reComment();" title="点击回复">
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
			<div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
            <div class="comment-re-title">
                <div class="comment-re-title-line">
                    <span class="title-text">全部回复</span>
                </div>
            </div>
		</li>
        <li>
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
            <div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
        </li>
        <li>
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
            <div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
        </li>
        <li>
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
            <div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
        </li>
        <li>
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
            <div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
        </li>
        <li>
            <div class="pull-left "><Avatar icon="person"/></div>
            <div class="pull-left comment-user-info">
                <p>用户名</p>
                <p>2017-11-08 17:50</p>
            </div>
            <div class="clear"></div>
            <div class="comment-content">中国的封门村，现在已经人尽皆知了，那是人们口中津津乐道的第一鬼城，也是让人望而却步的探险胜地。
                但你是否知道，在东北一个偏僻的小角落，坐落着一座荒芜的村庄，那里，是一个比封门村更为邪门的地方。
                因为这村子太邪门，知道的人因为忌讳，不愿意去说，而不知道的人也就一直不知道了。
                故而这村子虽为**，却没有封门村的名声叫得响亮。
                我小时候，就生活在这里，曾亲眼目睹了村子的变迁，目睹了一切的发生……
            </div>
        </li>
        <div class="comment-re-title">
            <div class="comment-re-title-line">
                <span class="title-text">回复内容</span>
            </div>
        </div>
        <div class="re-comment-text">
            回复内容框

        </div>
    </ul>

    <!-- <i-Form ref="ModelInfo">
        <Form-Item label="描述" prop="desc">
            <i-Input type="textarea"
                      size="large"
                      placeholder = "最多30个字符">
                    </i-Input>
        </Form-Item>
    </i-Form> -->
    <br>
    <p slot="footer"></p>
  </Modal>
    </div>
    <!--主体内容区结束-->

  </div>



<script>
    new Vue({
        el: '#app',
        data:{
          loading:false,
          commentModel:true,
          commentTopList:[],
		  commentReList:[],
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
              '/admin/comment/comment-list',
              {id:_that.request('id'),catid:_that.request('catid')},
              'get',
              function(res){
                _that.commentTopList = res.data.list;
                _that.searchData.total = res.data.count;
              },
              function(res){
                _that.$Message.warning('获取失败');
              },
            );
          },
          viewComment:function(k){
          	this.commentModel = true;
          },
          reComment:function () {
              alert();
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
		  //截取字符串
		  strLen:function(str,start,end){
		  	return str.slice(start, end)+'......';
		  }
		  
        }
    })
</script>



</body>
</html>