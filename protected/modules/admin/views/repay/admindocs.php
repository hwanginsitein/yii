<?php
/* @var $this RepayController */
/* @var $model Repay */

$this->breadcrumbs=array(
	'Repays'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'缴费列表', 'url'=>array('index')),
	array('label'=>'添加缴费', 'url'=>array('create')),
);
?>

<h1>已上传缴费文档</h1>
<table>
	<thead>
		<tr>
			<td>所在区域</td>
			<td>上传人</td>
			<td>上传时间</td>
			<td>已上传文档</td>
			<td>已缴费人数</td>
			<td>详情</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($repays as $repay){ ?>
			<tr>
				<td><?=$repay->area?></td>
				<td><?=$repay->uploader?></td>
				<td><?=$repay->time?></td>
				<td><?=$repay->upload_name?></td>
				<td>
					<?php
						$count = Repay::model()->count('docsId1',array($repay->id));
						echo $count;
					?>	
				</td>
				<td><a href="<?=$repay->id?>"><img src='/assets/436ba2b7/gridview/view.png'></a></td>
			</tr>
		<?php }?>
	</tbody>
</table>
<div>
	<a href="/admin/uploadDocs/createpaydoc"><button>上传更新缴费数据</button></a>
	<a href="/example1.xls" target="_blank">缴费文档格式</a>
</div>
<script type="text/javascript">
	$(function(){
		$("table").DataTable();
	})
</script>