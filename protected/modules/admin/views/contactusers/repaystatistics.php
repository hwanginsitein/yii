<div class="repay">
    <div class='span2'>
        <div class="word1">已缴费人数</div>
        <div class="square1"><?=$repayCount?>位</div>
    </div>
    <div class='span2'>
        <div class="word1">未缴费人员</div>
        <div class='square1'><?=$debtsCount-$repayCount?>位</div>
    </div>
    <div class='span2'>
        <div class="word1">完成比例</div>
        <div class='square1'><?=topercent($repayCount/$debtsCount);?></div>
    </div>
</div>
<div class="clear"></div>
<div class="row1">
    <button id="month1">近一个月缴费人数</button>
    <button id="month3">近三个月缴费人数</button>
    <input type="text" name="startdate"> 至 <input type="text" name="enddate">
    <button id="query1">确认搜索</button>
</div>
<div id="repays"></div>
<script>
    $("#query1").click(function(){
        var startdate = $("[name=startdate]").val();
        var enddate = $("[name=enddate]").val();
        getRepays(startdate,enddate);
    })
    $('[name=startdate]').datepicker({
        showButtonPanel: true
    });
    $('[name=enddate]').datepicker({
        showButtonPanel: true
    });
    $("#month1").click(function(){
        getRepays('<?=date("Y-m-d",strtotime("-1 months"))?>','');
    });
    $("#month3").click(function(){
        getRepays('<?=date("Y-m-d",strtotime("-3 months"))?>','');
    });
    var language = {"language": {
        "sInfo": "显示 _START_ 至 _END_ 共 _TOTAL_ 条",                          //汉化   
        "sLengthMenu": "每页显示 _MENU_ 条记录",   
        "sZeroRecords": "没有检索到数据", 
        "sInfoEmtpy": "没有数据",   
        "sProcessing": "正在加载数据...",   
        "oPaginate": {   
            "sFirst": "首页",   
            "sPrevious": "前页",   
            "sNext": "后页",   
            "sLast": "尾页"  
        }
    }}
    function getRepays(startdate,enddate){
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getallrepays",
            data:{startdate:startdate,enddate:enddate},
            success:function(data){
                $("#repays").html(data);
                $('table').DataTable(language);
            }
        })
    }
</script>