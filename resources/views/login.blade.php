<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="login-bg">

<div class="login">
    <div class="message">{{ env('APP_NAME') }} {{ env('APP_VERSION') }}</div>
    <div id="darkbannerwrap"></div>

    <form class="layui-form" >
        <input name="username" autocomplete="off"  placeholder="用户名"  type="text" lay-verify="required|username" class="layui-input" >
        <hr class="hr15">
        <input name="password" autocomplete="off"  lay-verify="required|password" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <input value="登录" api="{{ route('api.login') }}" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <hr class="hr20" >
    </form>
</div>

<script>
    layui.use( ['jquery','form','layer'], function(){
        var form        =   layui.form,
            layer       =   layui.layer,
            $           =   layui.jquery;
        // 自定义验证
        form.verify({
            username:function (value) {
                var reg = /^[a-zA-Z]{1}[a-zA-Z0-9]{7,19}$/i;
                if( !reg.test(value) )   return '用户名或密码不对';
            },
            password:function (value) {
                var reg = /^[a-zA-z]{1}[~@#$%^&*()_+<>:{}a-zA-Z0-9]{7,20}$/i;
                if( !reg.test(value) )   return '用户名或密码不对';
            },
        });

        form.on( 'submit(login)', function (obj) {
            var data        =   obj.field,
                api         =   $(this).attr('api');

            $.post( api, data, function(res){

                if( res.code == 2900 ){
                    location.href = '/';return ;
                }
                layer.msg( res.message );
            }, 'JSON' );

            return false;
        } );
        
        form.render();
    } );
</script>

</body>
</html>