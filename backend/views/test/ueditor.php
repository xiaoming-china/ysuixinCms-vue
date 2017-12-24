<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>完整demo</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
    <script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/public/admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/public/admin/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/public/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<div id="app">
    <div v-for="(item, index) in formDynamic.items">
        <script :id="item.e_name" type="text/plain">
            {{item.value}}
        </script>
    </div>
    <button @click="submit()">提交</button>

</div>

<script type="text/javascript">

</script>
<script>
    new Vue({
        el: '#app',
        data:function(){
            return {
                formDynamic: {
                    items: [
                        {
                            value: 'content内容',
                            type: 'editor',
                            e_name: 'content'
                        },
                        {
                            value: 'desc内容',
                            type: 'editor',
                            e_name: 'desc'
                        }
                    ]
                }
            }
        },
        mounted: function() {
            var _that = this;
            var length = this.formDynamic.items.length;
            var data   = this.formDynamic.items;
            for (var i = 0; i < length; i++) {
                if(data[i]['type'] === 'editor'){
                    UE.getEditor(data[i]['e_name']);
                }
            }
        },
        methods: {
            submit:function(){
              var _that = this;
              var length = this.formDynamic.items.length;
              var data   = this.formDynamic.items;
              for (var i = 0; i < length; i++) {
                 if(data[i]['type'] === 'editor'){
                    data[i].value = UE.getEditor(data[i]['e_name']).getContent();
                  }
                }
              console.log(data);
            }
        }
    })
</script>
</body>
</html>