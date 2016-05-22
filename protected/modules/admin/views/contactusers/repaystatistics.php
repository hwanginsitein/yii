<div class="repay">
    <div class='span2'>
        <div class="word1">已缴费人数</div>
        <div class="square1"><?=$repayCount?>位</div>
    </div>
    <div class='span2'>
        <div class="word1">未缴费人员</div>
        <div class='square1'><?=$debtsCount?>位</div>
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
</div>
<script>
    $('[name=startdate]').datepicker({
        showButtonPanel: true
    });
    $('[name=enddate]').datepicker({
        showButtonPanel: true
    });
    $("#month1").click(function(){
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getallrepays",
            data:{startdate:<?=date("Y-m-d",strtotime("-1 months"))?>},
            success:function(data){
                $("#repays").html(data);
            }
        })
    });
    $("#month3").click(function(){
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getallrepays",
            data:{startdate:<?=date("Y-m-d",strtotime("-3 months"))?>},
            success:function(data){
                $("#repays").html(data);
            }
        })
    });
</script>