<html>
<head>
    @include('head')
</head>
<body class="x-body">
{{-- 顶部工具栏 --}}
<div class="x-box">
    {{-- 表格搜索框 --}}
    <form class="layui-form x-search">
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <input type="text" name="username" lay-verify="required" placeholder="输入用户名后点击搜索"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit lay-filter="search">搜索</button>
            </div>
            <div class="layui-input-inline x-box-add-btn">
                <button type="button" class="layui-btn" onclick="openLayer('添加用户','{{ url('admin/create') }}')"><i class="layui-icon">&#xe61f;</i>添加用户</button>
            </div>
        </div>
    </form>
</div>
{{-- 数据表格 --}}
<table id="dataList" class="layui-table" lay-filter="current">

    {{-- 表格渲染 --}}
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
                ,{field: 'createdtime', title: '创建时间', width:'11%',sort:true,templet: '#createdtime'}
                ,{field: 'updatedby', title: '更新者', width:'7%'}
                ,{field: 'updatedtime', title: '更新时间', width:'11%',sort:true,templet: '#updatedtime'}
                ,{field: 'status', title: '状态', width:'5%',templet:'#status'}
                ,{field: 'email', title: '邮件', width:'10%'}
                ,{field: 'phone', title: '电话', width:'10%'}
                ,{ title: '操作', width:'',toolbar:'#bar',fixed: 'right'}
            ]]
            ,done:function (obj) {
                layer.msg('刷新成功');
            }
        });

        table.on( 'tool(current)',function (obj) {
            var curr    =   obj.event,
                data    =   obj.data,
                tr      =   obj.tr;

            if( curr == 'del' )
            {
                layer.confirm( '确定要删除此列吗?',{icon: 3, title:'提示'},function (index) {

//                    layer.clone(index);
                } );
            }else if( curr == 'edit' ){
                openLayer('编辑-'+data.name,'{{ url('admin/update') }}'+'/'+data.uuid);
            }else{
                layer.msg('show:'+data.uuid);
            }
        } );

        form.on('submit(search)',function (obj) {
            var where = obj.field;
            table.reload('adminTable',{
                where:where
            });
            return false;
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