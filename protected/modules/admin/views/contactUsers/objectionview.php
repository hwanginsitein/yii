<div>
	最新提出的异议
</div>
<table>
	<thead>
		<tr>
			<td>异议提出时间</td>
			<td>欠费用户姓名</td>
			<td>地区</td>
			<td>营业部</td>
			<td>异议理由</td>
			<td>异议处理内容</td>
			<td>能联系上的电话的</td>
			<td>用户是否缴费</td>
			<td>是否处理</td>
			<td>操作人</td>
			<td>详情</td>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($contactUsers as $k=>$contactUser){?>
			<tr>
				<td><?=$contactUser->objection_date?></td>
				<td><?=$contactUser->name?></td>
				<td><?=$contactUser->region?></td>
				<td><?=$contactUser->office?></td>
				<td><?=$contactUser->objection_reason?$contactUser->objection_reason:$contactUser->otherObjection?></td>
				<td><?=$contactUser->objection_handle?></td>
				<td><?=$contactUser->phone1?$contactUser->phone1:$contactUser->phone2?></td>
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
				<td><?=$contactUser->editor?></td>
				<td>
					<a href='/admin/contactUsers/update/id/<?=$contactUser->id?>' target='_blank'>
						<img src="/assets/436ba2b7/gridview/update.png">
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$(function(){
		$('table').DataTable({
			initComplete: function(){
				var api = this.api();
				api.columns().indexes().flatten().each(function(i){
					if(i == 2 || i == 3){
						var column = api.column(i);
						var select = $('<select><option value=""></option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							} );
						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					}
					if(1){

					}
				});
			}
		});
	})
</script>