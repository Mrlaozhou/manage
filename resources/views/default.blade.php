
<!DOCTYPE html>
<html>
<head>
    @include('head');
</head>
<body>
<div class="x-body">
    <fieldset class="layui-elem-field">
        <legend>工具栏</legend>
    </fieldset>

    <div class="layui-tab layui-tab-brief" lay-filter="demo">
        <ul class="layui-tab-title">
            <li class="layui-this">日期</li>
            <li>帮助</li>
            <li>备注</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div id="laydateDemo"></div>
            </div>
            <div class="layui-tab-item">
                <div id="pageDemo"></div>
            </div>
            <div class="layui-tab-item">

            </div>
        </div>
    </div>



</div>
<script>
    layui.use(['laydate',],function(){
        var laydate = layui.laydate;

        var dateIns = laydate.render({
            elem: '#laydateDemo'
            ,position: 'static'
            ,calendar: true //是否开启公历重要节日
            ,mark: { //标记重要日子
                '0-10-14': '生日'
                ,'2017-11-11': '剁手'
                ,'2017-11-30': ''
            }
            ,done: function(value, date, endDate){
                if(date.year == 2017 && date.month == 11 && date.date == 30){
                    dateIns.hint('一不小心就月底了呢');
                }
            }
            ,change: function(value, date, endDate){
                layer.msg(value)
            }
        });
    });
</script>
</body>
</html>