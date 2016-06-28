<div>
	最新提出的异议
</div>
<table>
	<thead>
		<tr>
			<td>异议提出时间</td>
			<td>欠费用户姓名</td>
			<td>异议理由</td>
			<td>异议处理内容</td>
			<td>用户是否缴费</td>
			<td>是否处理</td>
			<td>详情</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($contactUsers as $k=>$contactUser){?>
			<tr>
				<td><?=$contactUser->objection_date?></td>
				<td><?=$contactUser->name?></td>
				<td><?=$contactUser->objection_reason?$contactUser->objection_reason:$contactUser->otherObjection?></td>
				<td><?=$contactUser->objection_handle?></td>
				<td>
					<?php 
						if($contactUser->attitude==0){
							echo "不愿意缴费";
						}elseif($contactUser->attitude==1){
							echo "愿意缴费";
						}elseif($contactUser->attitude==-1){
							echo "拒不缴费态度恶劣";
						}
					?>
				</td>
				<td><?=$contactUser->objection_handle?$contactUser->objection_handle:""?></td>
				<td>
					<a href='/admin/contactUser/update/id/<?=$contactUser->id?>' target='_blank'>
						<img src="/assets/436ba2b7/gridview/update.png">
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$(function(){
		$('table').DataTable();
	})
</script>