<table>
    <tbody>
    <tr>
        <th>被催欠人</th>
        <th>身份证号</th>
        <th>手机号</th>
        <th></th>
    </tr>
<?php foreach($debts as $debt){ ?>
    <tr>
        <td><?=$debt->debtor?></td>
        <td><?=$debt->ID_number?></td>
        <td><?=$debt->telephone?></td>
        <td><a class="view" role="<?=$debt->ID_number?>">查看</a></td>
    </tr>
    </tbody>
<?php } ?>
</table>
<script>
    $('.view').click(function(){
        $("#new").html("");
        var idNumber = $(this).attr('role');
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getdebtor",
            data: {search:idNumber},
            success:function(d){
                if(d==0){
                    layer.msg('无数据');return;
                }
                $("#new").html(d);
            }
        })
        
    })
</script>