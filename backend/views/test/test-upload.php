<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.bootcss.com/vue/2.3.4/vue.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.16.2/axios.js"></script>
</head>

<body>
    <form>
        <input type="file" @change="getFile($event)">
        <button @click="submitForm($event,value)">提交</button>
    </form>

    <script>
        window.onload = function () {
            Vue.prototype.$http = axios;
            new Vue({
                el: 'form',
                data: {
                    file: ''
                },
                methods: {
                    getFile(event) {
                        this.file = event.target.files[0];
                        console.log(this.file);
                    },
                    submitForm(event) {
                        console.log(event);
                        event.preventDefault();
                        var formData = new FormData();
                        formData.append('File', this.file);
                        var config = {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                        this.$http.post('/admin/upload/upload', formData, config).then(function (res) {
                            if (res.status === 200) {
                                /*这里做处理*/
                                alert(res.status);
                            }
                        })
                    }
                }
            })
        }
    </script>
</body>

</html>