<table>
    <tbody>
    <tr>
        <th>被催欠人</th>
        <th>身份证号</th>
        <th>手机号</th>
        <th></th>
    </tr>
<?php foreach($ContactUsers as $ContactUser){ ?>
    <tr>
        <td><?=$ContactUser->name?></td>
        <td><?=$ContactUser->ID_number?></td>
        <td><?=$ContactUser->phone1?></td>
        <td><a class="view" role="<?=$ContactUser->ID_number?>" href="javascript:void(0)">查看</a></td>
    </tr>
    </tbody>
<?php } ?>
</table>
<script>
    $('.view').click(function(){
        var idNumber = $(this).attr('role');
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/getdebtor",
            data: {search:idNumber},
            success:function(d){
                if(d==0){
                    layer.msg('无数据');return;
                }else if(d>=1){
                    var id = d;
                    window.location.href="/admin/contactusers/update/id/"+id;
                    return false;
                }
                //$("#new").html(d);
            }
        })
        
    })
</script>