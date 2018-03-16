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
                <button type="button" class="layui-btn" onclick="openLayer('添加权限','{{ url('privilege/create') }}')"><i class="layui-icon">&#xe61f;</i>添加权限</button>
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
            ,height: 500
            ,url: '{{ route('api.privilege.index') }}' //数据接口
            ,page: true //开启分页
            ,limit: 100
            ,method: 'post'
            ,loading: true
            ,id: 'privilegeTable'
            ,cols: [[ //表头
                {field: 'name', title: '名称', width:'8%', templet: '#name'}
                ,{field: 'route', title: '路由', width:'12%'}
                ,{field: 'createdby', title: '创建者', width:'7%'}
                ,{field: 'createdtime', title: '创建时间',sort:true, width:'11%',templet: '#createdtime'}
                ,{field: 'updatedby', title: '更新者', width:'7%'}
                ,{field: 'updatedtime', title: '更新时间',sort:true, width:'11%',templet: '#updatedtime'}
                ,{field: 'status', title: '状态',sort:true, width:'7%',templet:'#status'}
                ,{field: 'mode', title: '模式', width:'7%'}
                ,{field: 'type', title: '类型',sort:true, width:'5%',templet: '#type'}
                ,{field: 'style', title: '显示', width:'10%',sort:true,templet: '#style'}
                ,{ title: '操作', width:'',toolbar:'#bar',fixed: 'right'}
            ]]
            ,done:function (obj) {
                layer.msg('刷新成功');
            },
            where: {
                _token: _TOKEN
            }
        });

        table.on( 'tool(current)',function (obj) {
            var curr    =   obj.event,
                data    =   obj.data,
                tr      =   obj.tr;

            if( curr == 'del' )
            {
                layer.confirm( '确定要删除此列吗?',{icon: 3, title:'提示'},function (index) {
                    $.post( "{{ route('api.privilege.delete') }}", {uuid:data.uuid,_token:_TOKEN}, function(res){
                        if( res.code == 2900 ) {
                            layer.msg('删除成功');
                            table.reload('privilegeTable');
                            return;
                        }else{
                            layer.msg( res.message );
                        }
                    },'JSON' );
                } );
            }else if( curr == 'edit' ){
                openLayer('编辑-'+data.name,'{{ url('privilege/update') }}'+'/'+data.uuid);
            }else{
                layer.msg('show:'+data.uuid);
            }
        } );

        form.on('submit(search)',function (obj) {
            var where = obj.field;
            table.reload('privilegeTable',{
                where:where
            });
            return false;
        });
    } );
</script>

{{-- name --}}
<script type="text/html" id="name">
    @{{ new Array(d.level).join('----')+d.name }}
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
{{-- type --}}
<script type="text/html" id="type">
    @{{#  if(d.type == '9'){ }}
    <span class="layui-badge">api</span>
    @{{#  } else { }}
    <span class="layui-badge layui-bg-gray">web</span>
    @{{#  } }}
</script>
{{-- style --}}
<script type="text/html" id="style">
    @{{#  if(d.style == 0){ }}
    <span class="layui-badge ">禁止显示</span>
    @{{#  } else if( d.style == 1 ) { }}
    <span class="layui-badge layui-bg-orange">仅侧栏显示</span>
    @{{#  } else if( d.style == 2 ) { }}
    <span class="layui-badge layui-bg-orange">仅授权显示</span>
    @{{#  } else if( d.style == 3 ) { }}
    <span class="layui-badge layui-bg-green">父级不显示</span>
    @{{#  } else if( d.style == 4 ) { }}
    <span class="layui-badge layui-bg-orange">仅父级显示</span>
    @{{#  } else if( d.style == 5 ) { }}
    <span class="layui-badge layui-bg-green">授权不显示</span>
    @{{#  } else if( d.style == 6 ) { }}
    <span class="layui-badge layui-bg-green">侧栏不显示</span>
    @{{#  } else { }}
    <span class="layui-badge layui-bg-gray">无限制</span>
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