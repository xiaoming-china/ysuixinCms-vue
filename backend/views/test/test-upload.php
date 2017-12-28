<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>上传</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/public/admin/ueditor/themes/default/css/ueditor.css" type="text/css">
   
    <style type="text/css">
        .demo-upload-list{
            display: inline-block;
            width: 60px;
            height: 60px;
            text-align: center;
            line-height: 60px;
            border: 1px solid transparent;
            border-radius: 4px;
            overflow: hidden;
            background: #fff;
            position: relative;
            box-shadow: 0 1px 1px rgba(0,0,0,.2);
            margin-right: 4px;
        }
        .demo-upload-list img{
            width: 100%;
            height: 100%;
        }
        .demo-upload-list-cover{
            display: none;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,.6);
        }
        .demo-upload-list:hover .demo-upload-list-cover{
            display: block;
        }
        .demo-upload-list-cover i{
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            margin: 0 2px;
        }
        .test{
            width: 100%;
            height: 80px;
        }
    </style>
</head>
<body>
<div id="app">
    <div  v-for="f_item in formDynamic">
    <div class="test">
        <div class="demo-upload-list" v-for="item in uploadList">
            <template v-if="item.status === 'finished'">
                <img :src="item.url">
                <div class="demo-upload-list-cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item.url)"></Icon>
                    <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
                </div>
            </template>
            <template v-else>
                <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
            </template>
        </div>
        <Upload
            ref="upload"
            :show-upload-list="false"
            :on-success="handleSuccess"
            :format="['jpg','jpeg','png']"
            :max-size="2048"
            multiple
            type="drag"
            action="/admin/upload/upload"
            name = "File"
            style="display: inline-block;width:58px;">
            <div style="width: 58px;height:58px;line-height: 58px;">
                <Icon type="camera" size="20"></Icon>
            </div>
        </Upload>
        <Modal title="View Image" v-model="visible">
            <img :src=imgName v-if="visible" style="width: 100%">
        </Modal>
    </div>
    </div>
  </div>  

<script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
<script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data:function(){
            return {
                imgName: '',
                visible: false,
                uploadList: [],
                formDynamic:[
                    {
                        value: '',
                        index: 1,
                        status: 1
                    },
                                        {
                        value: '',
                        index: 1,
                        status: 1
                    }
                ]
            }
        },
        mounted () {
            this.uploadList = this.$refs.upload.fileList;
        },
        methods: {
            handleView (url) {
                this.imgName = url;
                this.visible = true;
            },
            handleRemove (file) {
                const fileList = this.$refs.upload.fileList;
                this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            },
            handleSuccess (res, file) {
                console.log(file);
                var base_url = file.response.data.base_url;
                var path = file.response.data.path;
                var name = file.response.data.name;

                file.url = base_url+'/'+path+'/'+name;
                file.name = base_url+'/'+path+'/'+name;
            }
        }
    })
</script>
</body>
</html>