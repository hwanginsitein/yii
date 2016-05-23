<table>
    <thead>
        <tr>
            <th>日期</th>
            <th>欠费区域</th>
            <th>委托人</th>
            <th>欠费类型</th>
            <th>欠费期间</th>
            <th>人数</th>
            <th>标签</th>
            <th>已完成人数</th>
            <th>已完成比例</th>
            <th>备注</th>
            <th>详情</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($uploadDocs as $uploadDoc){ ?>
        <tr>
            <td><?=date("Y-m-d",$uploadDoc->time);?></td>
            <td><?=$uploadDoc->area;?></td>
            <td><?=$uploadDoc->clientele;?></td>
            <td><?=$uploadDoc->type;?></td>
            <td><?php echo $uploadDoc->starttime."至".$uploadDoc->endtime;?></td>
            <td><?php echo (count(json_decode($uploadDoc->detail,1))-1);?></td>
            <td><?=$uploadDoc->label;?></td>
            <td></td>
            <td></td>
            <td><?=$uploadDoc->comments;?></td>
            <td><?=$uploadDoc->information;?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div>
    <select name="area" id="area">
        <option value="">请选择</option>
        <option value="吉州区">吉州区</option>
        <option value="青原区">青原区</option>
        <option value="新干县">新干县</option>
        <option value="安福县">安福县</option>
        <option value="峡江县">峡江县</option>
        <option value="永丰县">永丰县</option>
        <option value="吉水县">吉水县</option>
        <option value="吉安县">吉安县</option>
        <option value="永新县">永新县</option>
        <option value="泰和县">泰和县</option>
        <option value="井冈山市">井冈山市</option>
        <option value="遂川县">遂川县</option>
        <option value="万安县">万安县</option>
    </select>
    <button id="query">查询</button>
</div>
<div class="repay1">
    <div class='span2'>
        <div class="word1">已缴费人数</div>
        <div class="square1" id="repayCount"></div>
    </div>
    <div class='span2'>
        <div class="word1">未缴费人员</div>
        <div class='square1' id="noPayCount"></div>
    </div>
    <div class='span2'>
        <div class="word1">完成比例</div>
        <div class='square1' id="percentage"></div>
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
    var language = {"language": {
        "sInfo": "显示 _START_ 至 _END_ 共 _TOTAL_ 条",
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
    $('table').DataTable(language);
    function changeTwoDecimal(x){
        var f_x = parseFloat(x);
        if (isNaN(f_x)){
            alert('function:changeTwoDecimal->parameter error');
            return false;
        }
        f_x = Math.round(f_x *100)/100;
        return f_x;
    }
    $("#query").click(function(){
        var region = $("#area").find("option:selected").val();
        if(region == ""){return false;}
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/GetAllRepayCount",
            data:{region:region},
            success:function(data){
                var obj = JSON.parse(data);
                var repayCount = obj[0];
                var debtsCount = obj[1];
                $("#repayCount").html(repayCount+"位");
                $("#noPayCount").html((debtsCount-repayCount)+"位");
                var percentage = changeTwoDecimal((repayCount/debtsCount))*100+"%";
                $("#percentage").html(percentage);
            }
        })
    })
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
    function getRepays(startdate,enddate,region){
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getallrepays",
            data:{startdate:startdate,enddate:enddate},
            success:function(data){
                $("#repays").html(data);
                $('#repaystable').DataTable(language);
            }
        })
    }
</script>