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
                    <input type="text" name="name"  lay-verify="required"
                           placeholder="请输入模式名称" autocomplete="off" class="layui-input" value="{{ $info['name'] or '' }}">
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
            {{-- desc --}}
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block" style="width:30%;">
                    <textarea name="desc" placeholder="请输入内容" class="layui-textarea">{{ $info['desc'] or '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="layui-tab-item">
            Nothing
        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset($info['uuid'])
                    <input type="hidden" name="uuid" value="{{ $info['uuid'] }}">
                @endisset
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset($info['uuid'])
                    <input type="hidden" name="uuid" name="{{ $info['uuid'] }}">
                @endisset

                <button class="layui-btn" url="{{ route('api.mode.create') }}" lay-submit lay-filter="create">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script src="/js/mode.js"></script>
</body>
</html>