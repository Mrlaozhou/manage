<html>
<head>
    @include('head')
</head>
<body class="x-body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">基本信息</li>
        <li>文章信息</li>
    </ul>
    <form class="layui-form layui-tab-content">
        <div class="layui-tab-item layui-show">
            {{-- title --}}
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block" style="width:30%;">
                    <input type="text" name="{{ $handle }}[title]" required  lay-verify="required"
                           placeholder="请输入标题" autocomplete="off" class="layui-input" value="{{ $info->title or '' }}">
                </div>
            </div>
            {{-- short --}}
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">简短介绍</label>
                <div class="layui-input-block"  style="width:30%;">
                    <textarea name="{{ $handle }}[short]" placeholder="请输入内容" class="layui-textarea">{{ $info->short or '' }}</textarea>
                </div>
            </div>
            {{-- cover --}}
            <div class="layui-form-item">
                <label class="layui-form-label">封面</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-upload-drag" id="cover">
                        <i class="layui-icon">&#xe67c;</i>
                        <p>点击上传，或将文件拖拽到此处</p>
                    </button>
                </div>
            </div>
            {{-- status --}}
            <div class="layui-form-item">
                <label class="layui-form-label">是否发布</label>
                <div class="layui-input-block">
                   @if( isset($info->status) && $info->status == 0 )
                        <input type="radio" name="{{ $handle }}[status]" value="1" title="是">
                        <input type="radio" name="{{ $handle }}[status]" value="0" title="否"  checked>
                       @else
                        <input type="radio" name="{{ $handle }}[status]" value="1" title="是"  checked>
                        <input type="radio" name="{{ $handle }}[status]" value="0" title="否">
                   @endif
                </div>
            </div>
            {{-- publishedtype --}}
            <div class="layui-form-item">
                <label class="layui-form-label">发布类型</label>
                <div class="layui-input-block">
                    @if( isset($info->publishedtype) && $info->publishedtype == 2 )
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="0" title="默认">
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="1" title="置顶">
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="2" title="推荐" checked>
                    @elseif(isset($info->publishedtype) && $info->publishedtype == 1)
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="0" title="默认">
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="1" title="置顶" checked>
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="2" title="推荐">
                    @else
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="0" title="默认" checked>
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="1" title="置顶">
                        <input type="radio" name="{{ $handle }}[publishedtype]" value="2" title="推荐">
                    @endif
                </div>
            </div>
            {{-- category --}}
            <div class="layui-form-item">
                <lable class="layui-form-label label-show">所属分类</lable>
                <div class="layui-input-inline">
                    <select name="category[0]" lay-verify="required">
                        <option value="">请选择分类</option>
                        @foreach( $categories as $key => $item )
                            <option value="{{ $item->uuid }}">{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$item->level-1) !!}{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <button type="button" class="layui-btn btn-show" onclick="addCategory(this)">添加 <i class="layui-icon">&#xe608;</i></button>
                </div>
            </div>
            @if( isset($relations) && $relations != [] )
                @foreach( $relations as $relk => $relv )
                    <div class="layui-form-item">
                        <lable class="layui-form-label label-show">分类{{ $relk+1 }}</lable>
                        <div class="layui-input-inline">
                            <select name="category[{{ $relk+1 }}]" lay-verify="required">
                                <option value="">请选择分类</option>
                                @foreach( $categories as $key => $item )
                                    <option value="{{ $item->uuid }}"
                                    @if( $item->uuid == $relv->cuuid )
                                        selected
                                    @endif
                                    >{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$item->level-1) !!}{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <button type="button" class="layui-btn btn-show" onclick="delCategory(this)">删除 <i class="layui-icon">&#x1006;</i></button>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="layui-tab-item">
            {{-- alias --}}
            <div class="layui-form-item">
                <label class="layui-form-label">内容</label>
                <div class="layui-input-block" style="width:80%;">

                </div>
            </div>
        </div>
        {{-- hidden --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                @isset( $info->uuid )
                    <input type="hidden" name="{{ $handle }}[uuid]" value="{{ $info->uuid or '' }}">
                @endisset
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="{{ $handle }}[cover]" value="{{ $info->cover or '' }}">
            </div>
        </div>
        {{-- submit --}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit api="{{ route('api.blog.'.$handle) }}" lay-filter="{{ $handle }}">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script>
    var rememberIndex = 1;
    layui.use( ['element','jquery','form','table','layer','upload'], function () {
        var element =   layui.element,
            form    =   layui.form,
            layer   =   layui.layer,
            upload  =   layui.upload,
            $       =   layui.jquery;

        form.on( 'submit({{ $handle }})',function (obj) {
            var data        =   obj.field,
                api         =   $(this).attr('api');
            console.log(data);
            $.post( api, data, function (res) {
                if( res.code == 2900 )
                {
                    // layer.msg('Successfully');
                    console.log(res);
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index);
                    parent.location.reload();
                    return ;
                }
                else
                {
                    layer.msg( res.message );
                }
            }, 'JSON' );

            return false;
        } );

        //头像上传
        upload.render({
            elem: '#cover'
            ,url: ''
            ,method: 'post'
            ,accept: 'file'
            ,auto: true
            ,size: 1000*1024
            ,exts:'jpg|png|gif|bmp|jpeg'
            ,done: function(res, index, upload){ //上传后的回调
                $('input[name="avatar"]').val(res.data.src);
            }
        });

        form.render();
    } );

    function addCategory(that) {
        layui.use( 'form',function () {
            var form    =   layui.form;
            var item        =   $(that).parent().parent(),
                newItem     =   item.clone();

            newItem.find('.label-show').html('分类'+rememberIndex);
            newItem.find('.btn-show').addClass('layui-btn-primary').html('删除 <i class="layui-icon">&#x1006;</i>').attr( 'onclick', "delCategory(this)" );
            newItem.find('select').attr('name','category['+rememberIndex+']');
            item.after(newItem);
            rememberIndex = rememberIndex+1;
            form.render();
        } );
    }

    function delCategory(that) {
        $(that).parent().parent().remove();
    }
</script>
</body>
</html>