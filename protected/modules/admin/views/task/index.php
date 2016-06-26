<h2>我的任务</h2>
<div class="margin-top-10"></div>
<table id="table1">
	<thead>
		<tr>
			<th>地区</th>
			<th>委托人</th>
			<th>文档</th>
			<th>用户人数</th>
			<th>已交费人数</th>
			<th>备注</th>
		</tr>
	</thead>
	<?php 
		if($uploadDocs){
		foreach($uploadDocs as $uploadDoc){ 
	?>
	<tr>
		<td><?=$uploadDoc->area?></td>
		<td><?=$uploadDoc->clientele?></td>
		<td><?=$uploadDoc->upload_name?></td>
		<td><?=ContactUser::model()->count("docsId=?",array($uploadDoc->id));?></td>
		<td><?=Repay::model()->count("docsId=?",array($uploadDoc->id));?></td>
		<td><?=$uploadDoc->comments?></td>
	</tr>
	<?php }}?>
</table>
<h2>我的催缴任务</h2>
<div class="margin-top-10"></div>
<table id="table2">
	<thead>
		<tr>
			<th>日期</th>
			<th>地区</th>
			<th>委托人</th>
			<th>文档</th>
			<th>用户人数</th>
			<th>已完成人数</th>
			<th>备注</th>
		</tr>
	</thead>
	<?php 
		if($uploadDocs){
		foreach($uploadDocs as $uploadDoc){ 
	?>
	<tr>
		<td><?=$uploadDoc->time?></td>
		<td><?=$uploadDoc->area?></td>
		<td><?=$uploadDoc->clientele?></td>
		<td><?=$uploadDoc->upload_name?></td>
		<td><?=ContactUsers::model()->count("docsId=?",array($uploadDoc->id));?></td>
		<td><?=ContactUsers::model()->count("docsId=? and repay_money = debt_money",array($uploadDoc->id));?></td>
		<td><?=$uploadDoc->comments?></td>
	</tr>
	<?php }}?>
</table>
<h2>当日任务</h2>
<?php
if($uploadDocs){
	$first = ContactUsers::model()->find("docsId=?",array($uploadDoc->id));//$uploadDoc->id
	$last = ContactUsers::model()->find("docsId=? order by id desc",array($uploadDoc->id));
	$firstLetter = $first->letterNumber;
	$lastLetter = $last->letterNumber;
?>
律师函编号：<?=$firstLetter."--".$lastLetter?>
<div class="margin-top-10"></div>
<div class="margin-top-10"><button style="width:80px"><a href="/admin/contactusers/update/id/<?=$first->id?>">开始</a></button></div>
<?php
	}
?>
<script type="text/javascript">
	$("#table1").DataTable();
	$("#table2").DataTable();
</script>