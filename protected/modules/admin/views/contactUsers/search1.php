<div>共搜索到<?=count($contactUsers);?>条结果</div>
<table id="search1">
	<THEAD>
		<tr>
			<td>名字</td>
			<td>欠款金额</td>
			<td>身份证</td>
			<td>联系号码</td>
			<td>新的联系方式</td>
			<td>缴费编号</td>
			<td>异议理由</td>
			<td>操作</td>
		</tr>
	</THEAD>
	<tbody>
		<?php foreach($contactUsers as $k=>$contactUser){?>
			<tr>
				<td><?=$contactUser->name?></td>
				<td><?=$contactUser->debt_money?></td>
				<td><?=$contactUser->ID_number?></td>
				<td><?=$contactUser->phone1?></td>
				<td><?=$contactUser->phone2?></td>
				<td><?=$contactUser->account_number?></td>
				<td><?=$contactUser->objection_reason?$contactUser->objection_reason:$contactUser->otherObjection?></td>
				<td>
					<a href="/admin/contactUsers/update/id/<?=$contactUser->id?>/next/<?=$contactUsers[$k+1]->id?>" target="_blank">
						<img src="/assets/436ba2b7/gridview/update.png">
					</a>
				</td>
			</tr>
		<?php }?>
	</tbody>
</table>