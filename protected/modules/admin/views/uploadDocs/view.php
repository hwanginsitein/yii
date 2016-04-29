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

<h1>View UploadDocs #<?php echo $model->id; ?></h1>
<table id="content1" class="display" cellspacing="0">
    <?php
    $detail = json_decode($model->showDetail);
    $footer = "";
    if ($detail) {
        foreach ($detail as $k => $v) {
            if ($k == 1) {
                echo "<thead>";
            } elseif ($k == 2) {
                echo "<tbody>";
            }
            echo "<tr>";
            foreach ($v as $k1 => $v1) {
                if ($k == 1) {
                    echo "<th>" . $v1 . "</th>";
                    $footer.= "<th>" . $v1 . "</th>";
                } else {
                    echo "<td>" . $v1 . "</td>";
                }
            }
            echo "</tr>";
            if ($k == 1) {
                echo "</thead>";
            } elseif ($k == 2) {
                echo "</tbody>";
            }
        }
    }
    echo $footer;
    ?>
</table>
<script>
    $('#content1').DataTable({});
</script>