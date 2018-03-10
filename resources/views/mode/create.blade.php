<html>
<head>
    @include('head')
    <script src="/js/mode_create.js"></script>
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