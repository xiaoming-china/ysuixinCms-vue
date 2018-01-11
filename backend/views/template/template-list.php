
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
        <div class="template-list" v-for ="(value,key) in templateList" @click="changeTemp(value.name)">
    			<div class="template-info">
    				<p class="cover"><img :src="value.icover" alt=""></p>
    				<p class="title">
              {{value.name}}
              <span v-if="value.used == 1">(当前模板)</span>
            </p>
    				<p class="is-select" :class="value.used == 1 ? 'on' :''" :id="value.name"></p>
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
          this.getTemplateList();
        },
        methods: {
          getTemplateList:function(){
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
          changeTemp:function(name){
            var _that = this;
            _that.$Modal.confirm({
                title:'操作确认',
                width:300,
                loading:true,
                content:'<p>是否确定使用此模板?</p>',
                onOk: () => {
                  $ajax(
                    '/admin/config/change-template', 
                    {temp_name:name}, 
                    'post',
                    function(res){
                      $('.is-select').removeClass('on');
                      $('#'+name).addClass('on');
                      _that.$Modal.remove();
                      _that.getTemplateList();
                    },
                    function(res){
                      _that.$Message.warning('更改失败');
                    },
                    false
                  );
                },
                onCancel: () => {
                  _that.$Modal.remove();
                }
            });
          }
        }
    })
</script>



</body>
</html>