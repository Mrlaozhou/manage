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
                <button type="button" class="layui-btn" onclick="openLayer('添加博客','{{ url('blog/create') }}')"><i class="layui-icon">&#xe61f;</i>添加博客</button>
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
            ,url: '{{ route('api.blog.index') }}' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,method: 'post'
            ,loading: true
            ,id: 'blogTable'
            ,cols: [[ //表头
                {field: 'title', title: '标题', width:'15%'}
                ,{field: 'createdby', title: '创建者', width:'7%'}
                ,{field: 'createdtime', title: '创建时间',sort:true, width:'11%',templet: '#createdtime'}
                ,{field: 'publishedtime', title: '发布时间',sort:true, width:'11%',templet: '#publishedtime'}
                ,{field: 'commentnum', title: '评论数',sort:true, width:'7%'}
                ,{field: 'clicks', title: '点击量', width:'7%'}
                ,{field: 'publishedtype', title: '类型',sort:true, width:'5%',templet: '#type'}
                ,{title: '顶/踩', width:'10%',sort:true,templet: '#result'}
                ,{field: 'status', title: '状态',sort:true, width:'7%',templet:'#status'}
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
                    $.post( "{{ route('api.blog.delete') }}", {uuid:data.uuid,_token:_TOKEN}, function(res){
                        if( res.code == 2900 ) {
                            layer.msg('删除成功');
                            table.reload('blogTable');
                            return;
                        }else{
                            layer.msg( res.message );
                        }
                    },'JSON' );
                } );
            }else if( curr == 'edit' ){
                openLayer('编辑-'+data.title,'{{ url('blog/update') }}'+'/'+data.uuid);
            }else{
                layer.msg('show:'+data.uuid);
            }
        } );

        form.on('submit(search)',function (obj) {
            var where = obj.field;
            table.reload('blogTable',{
                where:where
            });
            return false;
        });
    } );
</script>


{{-- issalt --}}
<script type="text/html" id="result">
    @{{ d.agree }} / @{{ d.oppose }}
</script>
{{-- status --}}
<script type="text/html" id="status">
    @{{#  if(d.status == 1){ }}
    <span class="layui-badge layui-bg-green">已发布</span>
    @{{# } else {  }}
    <span class="layui-badge layui-bg-gray">未发布</span>
    @{{#  } }}
</script>
{{-- type --}}
<script type="text/html" id="type">
    @{{#  if(d.publishedtype == 0){ }}
    <span class="layui-badge layui-bg-gray">默认</span>
    @{{#  } else if( d.publishedtype == 1 ) { }}
    <span class="layui-badge layui-bg-orange">置顶</span>
    @{{#  } else { }}
    <span class="layui-badge layui-bg-red">推荐</span>
    @{{#  } }}
</script>
<script  type="text/html" id="createdtime">
    @{{ timestampToTime(d.createdtime) }}
</script>
<script  type="text/html" id="publishedtime">
    @{{ timestampToTime(d.publishedtime) }}
</script>
<script type="text/html" id="bar">
    <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

</body>
</html>