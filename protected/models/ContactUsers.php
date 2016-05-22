<?php

/**
 * This is the model class for table "gz_contact_users".
 *
 * The followings are the available columns in table 'gz_contact_users':
 * @property integer $id
 * @property string $name
 * @property integer $debt_money
 * @property string $ID_number
 * @property string $phone1
 * @property integer $phone1_status
 * @property string $phone2
 * @property integer $phone2_status
 * @property string $phone3
 * @property string $region
 * @property string $address
 * @property string $account_number
 * @property integer $status
 * @property integer $sendLetter
 * @property string $sent_date
 * @property integer $receiveLetter
 * @property integer $ifrepay
 * @property string $repay_date
 * @property integer $repay_money
 * @property integer $attitude
 * @property string $objection_reason
 * @property integer $ifvalid
 * @property string $otherComments
 * @property string $proceed
 */
class ContactUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gz_contact_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, debt_money, status,overdue_time', 'required'),
			array('phone1_status, phone2_status, status, sendLetter, receiveLetter, ifrepay, repay_money, attitude, ifvalid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>12),
			array('ID_number', 'length', 'max'=>18),
			array('phone1, phone2, phone3', 'length', 'max'=>30),
			array('region, address, objection_reason, otherComments', 'length', 'max'=>255),
			array('account_number', 'length', 'max'=>15),
			array('sent_date, repay_date, proceed,otherObjection,objection_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, debt_money, ID_number, phone1, phone1_status, phone2, phone2_status, phone3, region, address, account_number,overdue_time, status, sendLetter, sent_date, receiveLetter, ifrepay, repay_date, repay_money, attitude, objection_reason, ifvalid, otherComments, proceed,otherObjection,objection_date', 'safe', 'on'=>'search'),
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
			'name' => '名字',
			'debt_money' => '欠款金额',
			'ID_number' => '身份证',
			'phone1' => '第一联系电话',
			'phone1_status' => '状态',
			'phone2' => '第二联系电话',
			'phone2_status' => '状态',
			'phone3' => '其他电话',
			'region' => '地区',
			'address' => '地址',
			'account_number' => '账号编号',
			'status' => '状态',
			'sendLetter' => '是否发送律师函',
			'sent_date' => '发送时间',
			'receiveLetter' => '是否收到律师函',
			'ifrepay' => '是否缴费',
			'repay_date' => '缴费日期',
			'repay_money' => '缴费金额',
			'attitude' => '用户态度',
			'objection_reason' => '异议理由',
			'ifvalid' => '异议是否成立',
			'objection_date' => '异议时间',
			'otherObjection' => '其他异议理由',
			'otherComments' => '其他记录',
			'proceed' => '催缴进程',
                        'overdue_time' => '停机时间'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('debt_money',$this->debt_money);
		$criteria->compare('ID_number',$this->ID_number,true);
		$criteria->compare('phone1',$this->phone1,true);
		$criteria->compare('phone1_status',$this->phone1_status);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('phone2_status',$this->phone2_status);
		$criteria->compare('phone3',$this->phone3,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sendLetter',$this->sendLetter);
		$criteria->compare('sent_date',$this->sent_date,true);
		$criteria->compare('receiveLetter',$this->receiveLetter);
		$criteria->compare('ifrepay',$this->ifrepay);
		$criteria->compare('repay_date',$this->repay_date,true);
		$criteria->compare('repay_money',$this->repay_money);
		$criteria->compare('attitude',$this->attitude);
		$criteria->compare('objection_reason',$this->objection_reason,true);
		$criteria->compare('ifvalid',$this->ifvalid);
		$criteria->compare('otherComments',$this->otherComments,true);
		$criteria->compare('proceed',$this->proceed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContactUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
