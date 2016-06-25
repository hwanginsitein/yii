<?php

/**
 * This is the model class for table "gz_debts".
 *
 * The followings are the available columns in table 'gz_debts':
 * @property integer $id
 * @property string $debt_number
 * @property integer $docsId
 * @property string $clientele
 * @property string $debtor
 * @property string $ID_number
 * @property string $telephone
 * @property string $account_number
 * @property string $debt_money
 * @property string $overdue_time
 * @property string $all
 * @property integer $ifpay
 * @property integer $status
 */
class Debts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gz_debts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('docsId, ifpay, status', 'required'),
			array('docsId, ifpay, status', 'numerical', 'integerOnly'=>true),
			array('debt_number', 'length', 'max'=>40),
			array('clientele, debtor', 'length', 'max'=>255),
			array('ID_number', 'length', 'max'=>18),
			array('telephone, debt_money', 'length', 'max'=>20),
			array('account_number', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, debt_number, docsId, clientele, debtor, ID_number, telephone, account_number, debt_money, overdue_time, ifpay, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'debt_number' => '催缴序号',
			'docsId' => '文档id',
			'clientele' => '委托人',
			'debtor' => '欠债人',
			'ID_number' => '欠债人身份证号码',
			'telephone' => '电话号码',
			'region' => '县区',
			'account_number' => '账号编号',
			'debt_money' => '欠费金额',
			'overdue_time' => '停机时间',
			'ifpay' => '是否缴费完整',
			'status' => '状态',
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
		$criteria->compare('debt_number',$this->debt_number,true);
		$criteria->compare('docsId',$this->docsId);
		$criteria->compare('clientele',$this->clientele,true);
		$criteria->compare('debtor',$this->debtor,true);
		$criteria->compare('ID_number',$this->ID_number,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('debt_money',$this->debt_money,true);
		$criteria->compare('overdue_time',$this->overdue_time,true);
		$criteria->compare('ifpay',$this->ifpay);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Debts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
