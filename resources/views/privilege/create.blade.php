<html>
<head>
    @include('head')
    <script src="/js/privilege_create.js"></script>
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
                <label class="layui-form-label">权限名称</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="name" required  lay-verify="required"
                           placeholder="请输入名称" autocomplete="off" class="layui-input" value="{{ $info['name'] or '' }}">
                </div>
            </div>
            {{-- route --}}
            <div class="layui-form-item">
                <label class="layui-form-label">路由</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="route" required  lay-verify="required"
                           placeholder="请输入路由" autocomplete="off" class="layui-input" value="{{ $info['route'] or '' }}">
                </div>
            </div>
            {{-- status --}}
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    @isset($info['status'])
                        @if( $info['status'] == '1' )
                            <input type="radio" name="status" value="1" title="开启" checked>
                            <input type="radio" name="status" value="0" title="关闭">
                        @else
                            <input type="radio" name="status" value="1" title="开启">
                            <input type="radio" name="status" value="0" title="关闭" checked>
                        @endif
                    @else
                        <input type="radio" name="status" value="1" title="开启" checked>
                        <input type="radio" name="status" value="0" title="关闭">
                    @endisset
                </div>
            </div>
            {{-- mode --}}
            <div class="layui-form-item">
                <label class="layui-form-label">验证模式</label>
                <div class="layui-input-block">
                    @foreach ( $modes as $mode )
                        <input type="radio" name="mode" value="{{ $mode['id'] }}" title="{{ $mode['name'] }}"
                            @if( isset($info['mode']) && $info['mode'] == $mode['id'] )
                                checked
                               @endif
                        >
                    @endforeach
                </div>
            </div>
            {{-- type --}}
            <div class="layui-form-item">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="type" value="1" title="web" checked>
                    <input type="radio" name="type" value="9" title="api">
                </div>
            </div>
        </div>
        <div class="layui-tab-item">

        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>