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
            {{-- name --}}
            <div class="layui-form-item">
                <label class="layui-form-label">模式名称</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[name]"  lay-verify="required"
                           placeholder="请输入模式名称" autocomplete="off" class="layui-input" value="{{ $info->name or '' }}">
                </div>
            </div>
            {{-- status --}}
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    @if( isset($info->status) && $info->status == '0' )
                            <input type="radio" name="{{ $handle }}[status]" value="1" title="开启">
                            <input type="radio" name="{{ $handle }}[status]" value="0" title="关闭" checked>
                        @else
                            <input type="radio" name="{{ $handle }}[status]" value="1" title="开启" checked>
                            <input type="radio" name="{{ $handle }}[status]" value="0" title="关闭">
                    @endif
                </div>
            </div>
            {{-- desc --}}
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block" style="width:30%;">
                    <textarea name="{{ $handle }}[desc]" placeholder="请输入内容" class="layui-textarea">{{ $info->desc or '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="layui-tab-item">
            Nothing
        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset($info->uuid)
                    <input type="hidden" name="{{ $handle }}[uuid]" value="{{ $info->uuid }}">
                @endisset
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" api="{{ route('api.mode.'.$handle) }}" lay-submit lay-filter="{{ $handle }}">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use( ['jquery','element','form','layer'],function () {
        var form    =   layui.form,
            layer   =   layui.layer,
            $       =   layui.jquery;
        // 添加监控
        form.on( 'submit({{ $handle }})',function(obj){
            var data    =   obj.field,
                api     =   $(this).attr('api');
            $.post(api,data,function(res){
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
                    layer.msg( res.message );
                }
            },'json');
            return false;
        } );

        form.render();
    } );
</script>
</body>
</html>