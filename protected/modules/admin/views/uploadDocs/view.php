<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs = array(
    'Upload Docs' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => '上传欠费文档', 'url' => array('create')),
    array('label' => '更新缴费数据', 'url' => array('update', 'id' => $model->id)),
    array('label' => '删除缴费数据', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '管理缴费数据', 'url' => array('admin')),
);
?>
<?php 
$debts = Debts::model()->findAll("docsId=?",array($model->id));
?>
<h1>查看<?=$model->area?> <?=$model->comments?> 用户数据</h1>
<table id="content1" class="display" cellspacing="0">
	<thead>
		<th>欠款用户</th>
		<th>身份证号码</th>
		<th>欠款金额</th>
		<th>停机时间</th>
		<th>催缴编号</th>
		<th>账户编号</th>
		<th>欠费号码</th>
	</thead>
	<tbody>
	<?php foreach($debts as $debt){?>
		<tr>
			<td><?=$debt->debtor?></td>
			<td><?=$debt->ID_number?></td>
			<td><?=$debt->debt_money?></td>
			<td><?=$debt->overdue_time?></td>
			<td><?=$debt->debt_number?></td>
			<td><?=$debt->account_number?></td>
			<td><?=$debt->telephone?></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<script>
    $('#content1').DataTable({});
</script>