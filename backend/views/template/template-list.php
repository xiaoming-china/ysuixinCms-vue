
    <!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
      <div class="card">
      	<div class="first-title">
			<a href="" class="crumbs">首页 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">设置 <e class="crumbs-symbol">></e></a>
			<a href="" class="crumbs">模板设置</a>
      	</div>
      </div>
      <div class="card" style="margin-bottom: 80px;">
        <div class="template-list">
    			<div class="template-info">
    				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
    				<p class="title">默认模板(当前模板)</p>
    				<p class="is-select on"></p>
    			</div>
    			<div class="template-info">
    				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
    				<p class="title">默认模板</p>
    				<p class="is-select"></p>
    			</div>
    			<div class="template-info">
    				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
    				<p class="title">默认模板</p>
    				<p class="is-select"></p>
    			</div>
    			<div class="template-info">
    				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
    				<p class="title">默认模板</p>
    				<p class="is-select"></p>
    			</div>
  		  </div>

      </div>

    </div>
    <!--主体内容区结束-->



<script>
    new Vue({
        el: '#app',
        data:{
          templateList:[],
        },
        mounted: function() {
          this.getTemplateListList();
        },
        methods: {
          getTemplateListList:function(){
            var _that = this;
            $ajax(
              '/admin/config/template-list', 
              '', 
              'post',
              function(res){
                _that.templateList = res.data.list;
              },
              function(res){
                _that.$Message.warning('模板列表获取失败');
              },
            );
          },
        }
    })
</script>



</body>
</html>