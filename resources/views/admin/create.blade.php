<html>
<head>
    @include('head')
</head>
<body class="x-body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">基本信息</li>
        <li>选填信息</li>
    </ul>
    <form class="layui-form layui-tab-content">
        <div class="layui-tab-item layui-show">
            {{-- username --}}
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[username]"  lay-verify="required|username"
                           @if( $handle == 'update' )
                                disabled
                           @endif
                           placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{ $info->username or '' }}">
                </div>
            </div>
            @if( $handle == 'created' )
                {{-- password --}}
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block" style="width:30%;">
                        <input type="password" name="{{ $handle }}[password]"  lay-verify="required|password"
                               placeholder="请输入密码" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            @else
                {{-- password --}}
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block" style="width:30%;">
                        <input type="password" name="{{ $handle }}[password]"  lay-verify="emptyOrPassword"
                               placeholder="请输入密码" autocomplete="off" class="layui-input" value="">
                    </div>
                </div>
            @endif
            {{-- password_confirmation --}}
            <div class="layui-form-item">
                <label class="layui-form-label">重复密码</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="password" name="{{ $handle }}[password_confirmation]"  lay-verify="password_confirmation"
                           placeholder="请输入密码" autocomplete="off" class="layui-input" value="">
                </div>
            </div>
            {{-- issalt 经创建用户时选择 --}}
            <div class="layui-form-item">
                <label class="layui-form-label">是否加盐</label>
                <div class="layui-input-block">
                    @if( isset($info->issalt) && $info->issalt == '0' )
                        <input type="radio" lay-filter="allowChoose" name="{{ $handle }}[issalt]" lay-verify="" value="1" title="是">
                        <input type="radio" lay-filter="allowChoose" name="{{ $handle }}[issalt]" lay-verify="" value="0" title="否" checked>
                    @else
                        <input type="radio" lay-filter="allowChoose" name="{{ $handle }}[issalt]" lay-verify="" value="1" title="是" checked>
                        <input type="radio" lay-filter="allowChoose" name="{{ $handle }}[issalt]" lay-verify="" value="0" title="否">
                    @endif
                </div>
            </div>
            {{-- status --}}
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    @isset($info->status)
                        @if( $info->status == '1' )
                            <input type="radio" name="{{ $handle }}[status]" value="1" title="开启" checked>
                            <input type="radio" name="{{ $handle }}[status]" value="0" title="关闭">
                        @else
                            <input type="radio" name="{{ $handle }}[status]" value="1" title="开启">
                            <input type="radio" name="{{ $handle }}[status]" value="0" title="关闭" checked>
                        @endif
                    @else
                        <input type="radio" name="{{ $handle }}[status]" value="1" title="开启" checked>
                        <input type="radio" name="{{ $handle }}[status]" value="0" title="关闭">
                    @endisset
                </div>
            </div>
            {{-- roles --}}
            <div class="layui-form-item">
                <label class="layui-form-label">角色</label>
                <div class="layui-input-block" style="width:60%;">

                            @foreach( $roles as $key => $item )
                                @if( isset($existsIds) && in_array( $item->uuid, $existsIds ) )
                                    <input type="checkbox" name="ruuids[]" value="{{ $item->uuid }}" title="{{ $item->name }}" lay-skin="" checked>
                                @else
                                    <input type="checkbox" name="ruuids[]" value="{{ $item->uuid }}" title="{{ $item->name }}" lay-skin="">
                                @endif
                            @endforeach

                </div>
            </div>
        </div>
        <div class="layui-tab-item">
            {{-- 邮箱 --}}
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[email]"  lay-verify="emptyOrEmail"
                           placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{ $info->email or '' }}">
                </div>
            </div>
            {{-- 电话 --}}
            <div class="layui-form-item">
                <label class="layui-form-label">电话</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[phone]"  lay-verify="emptyOrPhone"
                           placeholder="请输入电话" autocomplete="off" class="layui-input" value="{{ $info->phone or '' }}">
                </div>
            </div>
            {{-- intro --}}
            <div class="layui-form-item">
                <label class="layui-form-label">介绍</label>
                <div class="layui-input-block" style="width:30%;">
                    <textarea name="{{ $handle }}[intro]" placeholder="请输入介绍" class="layui-textarea">{{ $info->intro or '' }}</textarea>
                </div>
            </div>
            {{-- avatar --}}
            <div class="layui-form-item">
                <label class="layui-form-label">头像上传</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-upload-drag" id="uploadAvatar">
                        <i class="layui-icon">&#xe67c;</i>
                        <p>点击上传，或将文件拖拽到此处</p>
                    </button>
                </div>
            </div>
        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset($info->uuid)
                    <input type="hidden" name="{{ $handle }}[uuid]" value="{{ $info->uuid }}">
                @endisset
                <input type="hidden" name="{{ $handle }}[avatar]" value="{{ $info->avatar or '' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" api="{{ route('api.admin.'.$handle) }}" lay-submit lay-filter="{{ $handle }}">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
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
                var password = $('input[name="{{ $handle }}[password]"]').val();
                if( value !== password )    return '两次密码不一致！';
            },
            emptyOrPassword:function (value) {
                var reg = /^[a-zA-z]{1}[~@#$%^&*()_+<>:{}a-zA-Z0-9]{7,20}$/i;
                if( value != '' && !reg.test(value) )    return '密码为字母开头的8到20位~@#$%^&*()_+<>:{}a-zA-Z0-9';
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
        form.on( 'submit({{ $handle }})',function (obj) {
            var data    =   obj.field,
                api     =   $(this).attr('api');
            $.post(api,data,function (res) {
                if( res.code == 2900 )
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
        } );
        // 监听修改状态下 加盐模式切换
        @if( $handle == 'update' )
        form.on('radio(allowChoose)', function(data){
            var obj         =   data.value,
                password    =   $('input[name="update[password]"]').val();
            if( password == '' ) layer.msg('不重置密码 切换此项将毫无意义哟');
        });
        @endif
        form.render();
    } )
</script>
</body>
</html>