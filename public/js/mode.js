layui.use( ['jquery','element','form','layer'],function () {
    var form    =   layui.form,
        layer   =   layui.layer,
        $       =   layui.jquery;
    // 添加监控
    form.on( 'submit(create)',function(obj){
        var data    =   obj.field,
            api     =   $(this).attr('api');
        $.post(api,data,function(res){
            if( res.code == 200 )
            {
                layer.msg('Successfully');
                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                parent.layer.close(index);
                parent.location.reload();
                return ;
            }
            else
            {
                layer.open({
                    title : '错误提示',
                    type : 0,
                    content : res.error,
                });
            }
        },'json');
        return false;
    } );
} );