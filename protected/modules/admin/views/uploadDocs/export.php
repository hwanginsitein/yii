<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
    <table>
        <thead>
            <tr>
                <th><input type="checkbox" class="all"></th>
                <th>日期</th>
                <th>地区</th>
                <th>委托人</th>
                <th>欠费类型</th>
                <th>人数</th>
                <th>标签</th>
                <th>已完成人数</th>
                <th>已完成比例</th>
                <th>备注</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($uploadDocs as $uploadDoc){
                    $docsId = $uploadDoc->id;
                    $debtsCount = Debts::model()->count("docsId=?",array($docsId));
                    $repayCount = ContactUsers::model()->count("ifrepay=1 and docsId=?",array($docsId));
            ?>
            <tr>
                <td><input type="checkbox" name="docsId[]" class="uploaddoc" value="<?=$uploadDoc->id?>"></td>
                <td><?=$uploadDoc->time;?></td>
                <td><?=$uploadDoc->area;?></td>
                <td><?=$uploadDoc->clientele;?></td>
                <td><?=$uploadDoc->type;?></td>
                <td><?=$debtsCount;?></td>
                <td><?=$uploadDoc->label;?></td>
                <td><?=$repayCount;?></td>
                <td><?=topercent($repayCount/$debtsCount);?></td>
                <td><?=$uploadDoc->comments;?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <div>
        <select id="ifrepay" name="ifrepay">
            <option value="0">未缴费</option>
            <option value="1">已缴费</option>
        </select>
        <select id="ifcontact" name="ifcontact">
            <option value="1">能联系上欠费用户</option>
            <option value="3">不能联系上欠费用户</option>
        </select>
        <select id="ifsend" name="ifsend">
            <option value="0">未邮寄律师函</option>
            <option value="1">已邮寄律师函</option>
        </select>
    </div>
    <div style="margin-top: 10px;">
        <button>导出</button>
    </div>
</form>
<script>
    $(".all").click(function(){
        $(".uploaddoc").each(function(){
            $(this).prop("checked",$(".all").prop("checked"));
        })
    })
    //$("form").submit(function(){return false});
    $("button").click(function(){
    })
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
    $("table").DataTable(language);
</script>