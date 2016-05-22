<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'搜索联系用户', 'url'=>array('search')),
	array('label'=>'修改联系用户', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除联系用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>View联系用户 #<?php echo $model->id; ?></h1>

<?php 
$phoneStatus = array(1=>"能联系上欠费用户",2=>"机主不是欠费用户",3=>"无法联系");
$status = array(0=>"待审核",1=>"通过");
$letterStatus = array(0=>"否",1=>"是");
$attitude = array(0=>"不愿意缴费",1=>"愿意缴费");
$valid = array(0=>"不成立",1=>"成立");
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        //'id',
        'name',
        'debt_money',
        'ID_number',
        'phone1',
        array(            // display 'create_time' using an expression  
            'name'=>'phone1_status',  
            'value'=>$phoneStatus[$model->phone1_status],
        ),
        'phone2',
        array(            // display 'create_time' using an expression  
            'name'=>'phone2_status',  
            'value'=>$phoneStatus[$model->phone2_status],
        ),
        'phone3',
        'region',
        'address',
        'account_number',
        array(            // display 'create_time' using an expression  
            'name'=>'status',  
            'value'=>$letterStatus[$model->status],
        ),
        array(            // display 'create_time' using an expression  
            'name'=>'sendLetter',  
            'value'=>$letterStatus[$model->sendLetter],
        ),
        'sent_date',
        array(            // display 'create_time' using an expression  
            'name'=>'receiveLetter',  
            'value'=>$letterStatus[$model->receiveLetter],
        ),
        array(            // display 'create_time' using an expression  
            'name'=>'ifrepay',  
            'value'=>$letterStatus[$model->ifrepay],
        ),
        'repay_date',
        'repay_money',
        array(            // display 'create_time' using an expression  
            'name'=>'attitude',  
            'value'=>$attitude[$model->attitude],
        ),
        'objection_reason',
        array(            // display 'create_time' using an expression  
            'name'=>'ifvalid',  
            'value'=>$valid[$model->ifvalid],
        ),
        'otherComments',
        'proceed:html',
    ),
)); 
?>
