<html>
<head>
    @include('head')
</head>
<body class="x-body">
{{-- 顶部工具栏 --}}
<div class="x-box">
    <button class="layui-btn" onclick="openLayer('添加管理员','{{ url('admin/create') }}')">添加管理员</button>
</div>
{{-- 数据表格 --}}
<table id="dataList" class="layui-table">
    {{-- 表格搜索框 --}}
    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-input-inline"></div>
            <div class="layui-input-inline"></div>
        </div>
    </form>

</table>
<script>
    layui.use( ['table','jquery','layer','element','form'],function () {
        var table       =   layui.table,
            $           =   layui.jquery,
            layer       =   layui.layer,
            element     =   layui.element,
            form        =   layui.form;

        table.render({
            elem: '#dataList'
            // ,width:'100%'
            ,height: 450
            ,url: '{{ route('api.admin.index') }}' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,method: 'post'
            ,loading: true
            ,id: 'adminTable'
            ,cols: [[ //表头
                {field: 'username', title: '用户名', width:'8%'}
                ,{field: 'issalt', title: '是否加盐', width:'6%', templet:'#issalt'}
                ,{field: 'createdby', title: '创建者', width:'7%'}
                ,{field: 'createdtime', title: '创建时间', width:'11%',templet: '#createdtime'}
                ,{field: 'updatedby', title: '更新者', width:'7%'}
                ,{field: 'updatedtime', title: '更新时间', width:'11%',templet: '#createdtime'}
                ,{field: 'status', title: '状态', width:'5%',templet:'#status'}
                ,{field: 'email', title: '邮件', width:'10%'}
                ,{field: 'phone', title: '电话', width:'10%'}
                ,{ title: '操作', width:'',toobar:'#bar',fixed: 'right'}
            ]]
            ,done:function (obj) {
                layer.msg('刷新成功');
            }
        });
    } );
</script>

{{-- issalt --}}
<script type="text/html" id="issalt">
    @{{#  if(d.issalt == '1'){ }}
        <span class="layui-badge">是</span>
    @{{#  } else { }}
        <span class="layui-badge layui-bg-gray">否</span>
    @{{#  } }}
</script>
{{-- status --}}
<script type="text/html" id="status">
    @{{#  if(d.status == '1'){ }}
        <span class="layui-badge">开启</span>
    @{{#  } else { }}
        <span class="layui-badge layui-bg-gray">关闭</span>
    @{{#  } }}
</script>
<script  type="text/html" id="createdtime">
    @{{ timestampToTime(d.createdtime) }}
</script>
<script  type="text/html" id="updatedtime">
    @{{ timestampToTime(d.updatedtime) }}
</script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

</body>
</html>