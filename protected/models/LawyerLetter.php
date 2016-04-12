<?php

/**
 * This is the model class for table "gz_lawyer_letter".
 *
 * The followings are the available columns in table 'gz_lawyer_letter':
 * @property integer $id
 * @property string $letter_name
 * @property string $subject
 * @property string $description
 * @property string $content
 * @property string $debtor_name
 * @property string $debtor_ID
 * @property string $creditor_name
 * @property string $creditor_ID
 * @property integer $owe_money
 * @property string $reason
 * @property integer $status
 * @property string $lawyer
 * @property string $client
 * @property string $addressee
 * @property integer $reply_id
 */
class LawyerLetter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gz_lawyer_letter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('letter_name, debtor_name, debtor_ID, creditor_name, creditor_ID, status, lawyer, addressee', 'required'),
			array('owe_money, status, reply_id', 'numerical', 'integerOnly'=>true),
			array('letter_name, subject, description, debtor_name, creditor_name, reason, lawyer, client, addressee', 'length', 'max'=>255),
			array('debtor_ID, creditor_ID', 'length', 'max'=>17),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('letter_name, subject, description, content, debtor_name, debtor_ID, creditor_name, creditor_ID, owe_money, reason, status, lawyer, client, addressee, reply_id', 'safe', 'on'=>'search'),
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
			'letter_name' => 'Letter Name',
			'subject' => 'Subject',
			'description' => 'Description',
			'content' => 'Content',
			'debtor_name' => 'Debtor Name',
			'debtor_ID' => 'Debtor',
			'creditor_name' => 'Creditor Name',
			'creditor_ID' => 'Creditor',
			'owe_money' => 'Owe Money',
			'reason' => 'Reason',
			'status' => 'Status',
			'lawyer' => 'Lawyer',
			'client' => 'Client',
			'addressee' => 'Addressee',
			'reply_id' => 'Reply',
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
		$criteria->compare('letter_name',$this->letter_name,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('debtor_name',$this->debtor_name,true);
		$criteria->compare('debtor_ID',$this->debtor_ID,true);
		$criteria->compare('creditor_name',$this->creditor_name,true);
		$criteria->compare('creditor_ID',$this->creditor_ID,true);
		$criteria->compare('owe_money',$this->owe_money);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('lawyer',$this->lawyer,true);
		$criteria->compare('client',$this->client,true);
		$criteria->compare('addressee',$this->addressee,true);
		$criteria->compare('reply_id',$this->reply_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LawyerLetter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
