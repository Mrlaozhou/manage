layui.use( ['jquery','element','form','layer','upload'], function () {
    var element     =   layui.element,
        form        =   layui.form,
        layer       =   layui.layer,
        upload      =   layui.upload,
        $           =   layui.jquery;
    // 自定义验证
    form.verify({
        username:function (value) {
            var reg = /^[a-zA-Z]{1}[a-zA-Z0-9]{7,19}$/i;
            if( !reg.test(value) )   return '用户名为字母开头的8到20位字母数字';
        },
        password:function (value) {
            var reg = /^[a-zA-z]{1}[~@#$%^&*()_+<>:{}a-zA-Z0-9]{7,20}$/i;
            if( !reg.test(value) )   return '密码为字母开头的8到20位~@#$%^&*()_+<>:{}a-zA-Z0-9';
        },
        password_confirmation:function(value){
            var password = $('input[name="password"]').val();
            if( value !== password )    return '两次密码不一致！';
        },
        emptyOrEmail:function(value){
            if( value != '' && !this.email[0].test(value) )
                return this.email[1];
        },
        emptyOrPhone:function (value) {
            if( value != '' && !this.phone[0].test(value) )
                return this.phone[1];
        },
        emptyOrPassword:function (value) {
            var reg = /^[a-zA-z]{1}[~@#$%^&*()_+<>:{}a-zA-Z0-9]{7,20}$/i;
            if( value != '' && !reg.test(value) )
                return '密码为字母开头的8到20位~@#$%^&*()_+<>:{}a-zA-Z0-9';
        },
        enum:function(value){
            if( !$.inArray(value,['1','0','-7','9']) )
                return '列举值有误';
        },

    });
    //头像上传
    upload.render({
        elem: '#uploadAvatar'
        ,url: ''
        ,method: 'post'
        ,accept: 'file'
        ,auto: true
        ,size: 1000*1024
        ,exts:'jpg|png|gif|bmp|jpeg'
        ,done: function(res, index, upload){ //上传后的回调
            $('input[name="avatar"]').val(res.data.src);
        }
    });
    // 监听添加
    form.on( 'submit(create)',function (obj) {
        var data    =   obj.field,
            api     =   $(this).attr('api');
        $.post(api,data,function (res) {
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
        },'JSON');

        return false;
    } )
} )