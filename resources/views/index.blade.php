<!doctype html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="/">{{ env('APP_NAME') }} {{ env('APP_VERSION') }}</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="layui-icon">&#xe65f;</i>
    </div>
    <ul class="layui-nav left fast-add" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">+助手</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="openLayer('百度','http://www.baidu.com')"><i class="layui-icon">&#xe615;</i>百度</a></dd>
                <dd><a onclick="openLayer('谷歌','https://www.google.com.hk/')"><i class="layui-icon">&#xe615;</i>谷歌</a></dd>
                <dd><a onclick="openLayer('地图','http://map.baidu.com')"><i class="layui-icon">&#xe715;</i>地图</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">老周</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="openLayer('个人信息','http://www.baidu.com')">个人信息</a></dd>
                <dd><a href="/logout">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <foreach name="btns" item="v" >
                <li>
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe612;</i>
                        <cite>RBAC</cite>
                        <i class="layui-icon nav_right">&#xe603;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a _href="{{ url('privilege/index') }}">
                                <i class="layui-icon">&#xe602;</i>
                                <cite>权限列表</cite>
                            </a>
                        </li >
                        <li>
                            <a _href="{{ url('privilege/create') }}">
                                <i class="layui-icon">&#xe602;</i>
                                <cite>添加权限</cite>
                            </a>
                        </li >
                        <li>
                            <a _href="{{ url('mode/create') }}">
                                <i class="layui-icon">&#xe602;</i>
                                <cite>添加模式</cite>
                            </a>
                        </li >
                        <li>
                            <a _href="{{ url('admin/index') }}">
                                <i class="layui-icon">&#xe602;</i>
                                <cite>管理员列表</cite>
                            </a>
                        </li >
                        <li>
                            <a _href="{{ url('admin/create') }}">
                                <i class="layui-icon">&#xe602;</i>
                                <cite>添加用户</cite>
                            </a>
                        </li >
                    </ul>
                </li>
            </foreach>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='/default' scrolling="" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">© Copyright 2018 by LaoZhou</div>
</div>
</body>
</html>