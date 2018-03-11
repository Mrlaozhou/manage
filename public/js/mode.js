layui.use( ['jquery','element','form','layer'],function () {
    var form    =   layui.form,
        layer   =   layui.layer,
        $       =   layui.jquery;
    // 添加监控
    form.on( 'submit(create)',function(obj){
        var data    =   obj.field,
            api     =   $(this).attr('api');
        $.post(api,data,function(res){
            layer.msg('Successful!');
        },'json');
        return false;
    } );
} );