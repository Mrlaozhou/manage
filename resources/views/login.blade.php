<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME')  }}</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/public.css">
    <script src="layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/public.js"></script>
</head>
<body class="login-bg">

<div class="login">
    <div class="message">{{ env('APP_NAME') }} {{ env('APP_VERSION') }}</div>
    <div id="darkbannerwrap"></div>

    <form method="post" action="/login.html" class="layui-form" >
        <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    
</script>



</body>
</html>