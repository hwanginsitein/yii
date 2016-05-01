<?php

/**
 * This is the model class for table "gz_repay".
 *
 * The followings are the available columns in table 'gz_repay':
 * @property integer $id
 * @property integer $paid_ID
 * @property string $payId
 * @property integer $debt
 * @property integer $paid_money
 * @property integer $docsId
 */
class Repay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gz_repay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paid_ID, payId, paid_money, docsId', 'required'),
			array('paid_ID, paid_money, docsId', 'numerical', 'integerOnly'=>true),
			array('payId,paid_ID', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, paid_ID, payId, paid_money, docsId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '编号',
			'paid_ID' => '还款人身份证号码',
			'payId' => '缴费编号',
			'paid_money' => '缴费金额',
			'docsId' => '文档ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('paid_ID',$this->paid_ID,true);
		$criteria->compare('payId',$this->payId,true);
		$criteria->compare('paid_money',$this->paid_money,true);
		$criteria->compare('docsId',$this->docsId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Repay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
