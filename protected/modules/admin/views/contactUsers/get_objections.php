<div>
    <?php 
        foreach($contacts as $key => $contact){
            echo "<div>".date("Y年m月d日",strtotime($key))."</div><div>";
            foreach($contact as $k=>$v){
    ?>
        <button class="contact <?php if($v->ifvalid != 2){echo 'btn-success';}else{echo 'btn-warning';}?>"><?=$v->name;?></button>
    <?php 
            }
            echo "</div>";
        }
    ?>
</div>
<hr>
<div id='new'>
    
</div>
<script>
    $(".contact").click(function(){
        var search = $(this).html();
        if(!search){layer.msg('请输入');return false;}
        $.ajax({
            type: "POST",
            url: "/admin/contactusers/GetContactUser",
            data: {search:search},
            success:function(d){
                if(d==0){
                    layer.msg('无数据');return;
                }else if(d>=1){
                    var id = d;
                    window.location.href="/admin/contactusers/update/id/"+id;
                    return false;
                }
                $("#new").html("");
                $("#new").html(d);
            }
        })
    });
</script>