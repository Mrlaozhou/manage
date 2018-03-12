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
                    <input type="text" name="username"  lay-verify="required|username"
                           placeholder="请输入用户名" autocomplete="off" class="layui-input" value="{{ $info['username'] or '' }}">
                </div>
            </div>
            {{-- password --}}
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="password" name="password"  lay-verify="required|password"
                           placeholder="请输入密码" autocomplete="off" class="layui-input" value="">
                </div>
            </div>
            {{-- password_confirmation --}}
            <div class="layui-form-item">
                <label class="layui-form-label">重复密码</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="password" name="password_confirmation"  lay-verify="password_confirmation"
                           placeholder="请输入密码" autocomplete="off" class="layui-input" value="">
                </div>
            </div>
            {{-- issalt --}}
            <div class="layui-form-item">
                <label class="layui-form-label">是否加盐</label>
                <div class="layui-input-block">
                    @isset($info['issalt'])
                        @if( $info['issalt'] == '1' )
                            <input type="radio" name="issalt" lay-verify="" value="1" title="是" checked>
                            <input type="radio" name="issalt" lay-verify="" value="0" title="否">
                        @else
                            <input type="radio" name="issalt" lay-verify="" value="1" title="是">
                            <input type="radio" name="issalt" lay-verify="" value="0" title="否" checked>
                        @endif
                    @else
                        <input type="radio" name="issalt" lay-verify="" value="1" title="是" checked>
                        <input type="radio" name="issalt" lay-verify="" value="0" title="否">
                    @endisset
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
        </div>
        <div class="layui-tab-item">
            {{-- 邮箱 --}}
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="email"  lay-verify="emptyOrEmail"
                           placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="{{ $info['email'] or '' }}">
                </div>
            </div>
            {{-- 电话 --}}
            <div class="layui-form-item">
                <label class="layui-form-label">电话</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="phone"  lay-verify="emptyOrPhone"
                           placeholder="请输入电话" autocomplete="off" class="layui-input" value="{{ $info['phone'] or '' }}">
                </div>
            </div>
            {{-- intro --}}
            <div class="layui-form-item">
                <label class="layui-form-label">介绍</label>
                <div class="layui-input-block" style="width:30%;">
                    <textarea name="intro" placeholder="请输入介绍" class="layui-textarea">{{ $info['intro'] or '' }}</textarea>
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
                @isset($info['uuid'])
                    <input type="hidden" name="uuid" value="{{ $info['uuid'] }}">
                @endisset
                <input type="hidden" name="avatar" value="{{ $info['avatar'] or '' }}">
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" api="{{ route('api.admin.create') }}" lay-submit lay-filter="{{ $handle }}">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script src="/js/admin.js"></script>
</body>
</html>