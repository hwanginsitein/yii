<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs=array(
	'Upload Docs'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'Create UploadDocs', 'url'=>array('create')),
    array('label'=>'Update UploadDocs', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete UploadDocs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage UploadDocs', 'url'=>array('admin')),
);
?>

<h1>View UploadDocs #<?php echo $model->id; ?></h1>
<table id="content1" class="display" cellspacing="0">
<?php
    $detail = json_decode($model->detail);
    $footer = "";
    if($detail){
        foreach($detail as $k=>$v){
            if($k==1){
                echo "<thead>";
            }elseif($k==2){
                echo "<tbody>";
            }
            echo "<tr>";
            foreach($v as $k1=>$v1){
                if($k == 1){
                    echo "<th>".$v1."</th>";
                    $footer.= "<th>".$v1."</th>";
                }else{
                    echo "<td>".$v1."</td>";
                }
            }
            echo "</tr>";
            if($k==1){
                echo "</thead>";
            }elseif($k==2){
                echo "</tbody>";
            }
            if($k>=2){break;}
        }
    }
    echo $footer;
?>
</table>
<div class="form">
    <form action="" method="post">
        <div class="row">
            <label class="required">选择对应字段</label>
        </div>
        <div>
            欠费用户姓名：<input type="text" name="name">
        </div>
        <div>
            欠费用户身份证号码：<input type="text" name="ID">
        </div>
        <div>
            欠费金额：<input type="text" name="money">
        </div>
        <div>
            选择其他要显示的列：<input type="text" name="others">
        </div>
        <div>
            <input type="submit" value="确认">
        </div>
    </form>
</div>