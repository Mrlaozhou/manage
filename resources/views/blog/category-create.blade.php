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
            {{-- pid --}}
            <div class="layui-form-item">
                <label class="layui-form-label">父级元素</label>
                <div class="layui-input-inline">
                    <select name="{{ $handle }}[pid]" lay-verify="">
                        <option value="">顶级权限</option>
                        @isset( $parents )
                            @foreach( $parents as $key => $v )
                                <option
                                        @isset( $info->pid )
                                                @if( $info->pid == $v->uuid )
                                                    selected
                                                @endif
                                                @if( in_array($v->uuid,$subIds) )
                                                    disabled
                                                @endif
                                        @endisset
                                        value="{{ $v->uuid }}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level-1) !!}{{ $v->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            {{-- name --}}
            <div class="layui-form-item">
                <label class="layui-form-label">权限名称</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[name]" required  lay-verify="required"
                           placeholder="请输入名称" autocomplete="off" class="layui-input" value="{{ $info->name or '' }}">
                </div>
            </div>
            {{-- alias --}}
            <div class="layui-form-item">
                <label class="layui-form-label">标识</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[sign]" lay-verify=""
                           placeholder="请输入别名" autocomplete="off" class="layui-input" value="{{ $info->sign or '' }}">
                </div>
            </div>
            {{-- status --}}
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    @isset($info->status)
                        @if( $info->status == 1 )
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
        </div>
        <div class="layui-tab-item">

        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset( $info->uuid )
                    <input type="hidden" name="{{ $handle }}[uuid]" value="{{ $info->uuid or '' }}">
                @endisset
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit api="{{ route('api.blog.category.'.$handle) }}" lay-filter="{{ $handle }}">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use( ['element','jquery','form','table','layer'], function () {
        var element =   layui.element,
            form    =   layui.form,
            layer   =   layui.layer,
            $       =   layui.jquery;

        form.on( 'submit({{ $handle }})',function (obj) {
            var data        =   obj.field,
                api         =   $(this).attr('api');
            console.log(data);
            $.post( api, data, function (res) {
                if( res.code == 2900 )
                {
                    // layer.msg('Successfully');
                    console.log(res);
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index);
                    parent.location.reload();
                    return ;
                }
                else
                {
                    layer.msg( res.message );
                }
            }, 'JSON' );

            return false;
        } );

        form.render();
    } );
</script>
</body>
</html>