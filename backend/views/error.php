
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title>错误提示</title>
    <!-- Bootstrap core CSS -->
    <link href="/public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/admin/css/style.css" rel="stylesheet">
    <link href="/public/admin/css/style-responsive.css" rel="stylesheet" />
    <style>
      .form-signin{
        text-align: center;
      }
      .form-signin-heading{
        background: #f67a6e !important;
        color: #b5d4ea;
        padding: 10px 15px !important;
      }
      .return-button {
          color: #333;
          background: #e6e6e6 url("../../public/admin/img/btn.png");
          border: 1px solid #c4c4c4;
          border-radius: 2px;
          text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
          padding: 5px 10px;
          display: inline-block;
          font-size: 100%;
          line-height: normal;
          text-decoration: none;
          overflow: visible;
          vertical-align: middle;
          text-align: center;
          zoom: 1;
          white-space: nowrap;
          font-family: inherit;
      }
      .error-info{
        color: #f67a6e !important;
      }
    </style>
</head>

  <body class="login-body">
    <div class="container">
      <form class="form-signin">
      <h2 class="form-signin-heading">错误提示</h2>
        <div class="login-wrap">
            <p class="error-info"><?=$message; ?></p>
            <p>
              页面跳转</a> 等待时间 <b id="wait"><?php echo($waitSecond); ?></b>s
            </p>
            <a class="return-button" href="<?php echo($jumpUrl); ?>" id="href">返回</a>
        </div>
      </form>
    </div>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript">
      (function(){
          var waitSecond = $('#wait').html();
          var href = $('#href').attr('href');
          var interval = setInterval(function(){
            var time = --waitSecond;
            $('#wait').html(time);
            if(time <= 0) {
              location.href = href;
              clearInterval(interval);
            };
          }, 1000);
      })();
      </script>

  </body>
</html>
