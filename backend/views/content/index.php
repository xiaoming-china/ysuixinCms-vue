<link href="/public/admin/css/zTree/zTreeStyle.css" rel="stylesheet" type="text/css" />
<div class="right-content" id="app">
  <div class="card">
  <div v-if="categoryList.length =0">暂无栏目，请先添加栏目</div>
  <div else>
    <ul id="treeDemo" class="ztree"></ul>
  </div>
  </div>

</div>



<script>
    new Vue({
        el: '#app',
        data: {
          categoryList: []
      },
      mounted: function() {
        this.getTreeData();
      },
      methods: {
        getTreeData:function(tree){
          var _that = this;
          $ajax(
              '/admin/content/index',
              '', 
              'post',
              function(res){
                $.fn.zTree.init($("#treeDemo"), {}, res.data);
                $.fn.zTree.getZTreeObj("treeDemo").expandAll(true);
                _that.categoryList = res.data;
              },
              function(res){}
          );
      }
    }
    })
  </script>


<script src="/public/admin/js/jquery.ztree.core.js"></script>

</body>
</html>