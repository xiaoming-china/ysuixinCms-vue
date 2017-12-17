<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="main-content">

    <div class="first-title">系统信息</div>
    <ul class="first-item">
    	<li>操作系统：Linux</li>
    	<li>运行环境：Apach</li>
    	<li>PHP版本：7.0</li>
    	<li>文件上传限制：2M</li>
    	<li>数据库环境：mysql</li>
    	<li>数据库版本：5.6</li>
    	<li>网站剩余空间：50G</li>
    </ul>
    <div class="first-title">开发者信息</div>
    <ul class="first-item">
    	<li>开发者名称：<?=$developer_info['name']; ?></li>
    	<li>联系邮箱：<?=$developer_info['email']; ?></li>
    </ul>
    <div class="first-title">登录日志</div>
    <ul class="first-item">
    <table class="logo-log">
      <tbody>
<?php foreach($login_list as $k => $v ): ?>
        <tr>
          <td width="800">登录账户：<?= $v['username']; ?> ／ IP：<?= $v['ip']; ?> （<?= $v['area']; ?>）</td>
          <td><?= date('Y-m-d H:i:s',$v['created_at']); ?></td>  
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </ul>

</div>



</body>
</html>