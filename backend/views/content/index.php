<div class="right-content" id="app">
  <div class="card">
    <div class="zTree-list-box" v-if="categoryList.length =0">暂无栏目，请先添加栏目</div>
    <div class="zTree-list-box"  else>
      <ul id="treeDemo" class="ztree"></ul>
    </div>
  </div>
  <div class="card">
    <div class="content-list-box">请选择左侧栏目</div>
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
                            var catid = treeNode.catid;//栏目ID
                            //保存当前点击的栏目ID
                            sessionStorage.setItem("tree_catid",catid);
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
                    var tree_catid = sessionStorage.getItem("tree_catid");
                    if(tree_catid != null){
                      var nodes = zTree.getNodesByParam("catid", tree_catid, null);
                      zTree.selectNode(nodes[0]);
                    }
                _that.categoryList = res.data;
              },
              function(res){}
          );
      }
    }
    })
  </script>




</body>
</html>