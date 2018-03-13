<html>
<head>
    @include('head')
</head>
<body class="x-body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">基本信息</li>
        <li>权限列表</li>
    </ul>
    <form class="layui-form layui-tab-content">
        <div class="layui-tab-item layui-show">
            {{-- name --}}
            <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[name]" required  lay-verify="required"
                           placeholder="请输入名称" autocomplete="off" class="layui-input" value="{{ $info->name or '' }}">
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
            {{-- sign --}}
            <div class="layui-form-item">
                <label class="layui-form-label">标识</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[sign]" lay-verify=""
                           placeholder="请输入标识" autocomplete="off" class="layui-input" value="{{ $info->sign or '' }}">
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
            {{-- privileges --}}
            <div class="layui-form-item">
                <label class="layui-form-label">权限列表</label>
                <div class="layui-input-block" style="width:80%;">
                    <table class="layui-table">
                        <tbody>
                        @foreach( $privileges as $key => $item )
                            <tr>
                                <td>{{ $item->name }}</td>
                                @foreach( $item->son as $k => $v )
                                    <td><input type="checkbox" value="{{ $v->uuid }}" name="{{ $handle }}[puuids]" title="{{ $v->name }}"></td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset( $info->uuid )
                    <input type="hidden" name="{{ $handle }}[uuid]" value="{{ $info->uuid or '' }}">
                @endisset
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit api="{{ route('api.role.'.$handle) }}" lay-filter="{{ $handle }}">立即提交</button>
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
            // $.post( api, data, function (res) {
            //     if( res.code == 2900 )
            //     {
            //         // layer.msg('Successfully');
            //         var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            //         parent.layer.close(index);
            //         parent.location.reload();
            //         return ;
            //     }
            //     else
            //     {
            //         layer.open({
            //             title : '错误提示',
            //             type : 0,
            //             content : res.error,
            //         });
            //     }
            // }, 'JSON' );

            return false;
        } );
    } );
</script>
</body>
</html>