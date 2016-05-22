<div id="objection_content">
    <div>
        <span>提出异议的用户</span>
        <span><button id="allObjectionusers">显示所有的异议用户</button></span>
        <span><button id="validObjectionusers">显示异议成立用户</button></span>
    </div>
    <div id="objections">
        
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#allObjectionusers").click(function(){
            $.ajax({
                type: "POST",
                url: "/admin/contactusers/getObjections",
                success:function(data){
                    $("#objections").html(data);
                }
            })
        });
        $("#validObjectionusers").click(function(){
            $.ajax({
                type: "POST",
                url: "/admin/contactusers/getObjections",
                data:{ifvalid:1},
                success:function(data){
                    $("#objections").html(data);
                }
            })
        });
    })
</script>