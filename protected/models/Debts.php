<?php

/**
 * This is the model class for table "gz_debts".
 *
 * The followings are the available columns in table 'gz_debts':
 * @property integer $id
 * @property integer $docsId
 * @property string $clientele
 * @property string $debtor
 * @property string $ID_number
 * @property string $telephone
 * @property string $account_number
 * @property string $debt_money
 * @property string $pay_money
 * @property integer $ifpay
 * @property string $others
 * @property integer $status
 */
class Debts extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'gz_debts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('docsId, clientele, debtor, ID_number, telephone, debt_money, pay_money, ifpay, status', 'required'),
            array('docsId, ifpay, status', 'numerical', 'integerOnly' => true),
            array('clientele, debtor', 'length', 'max' => 255),
            array('ID_number', 'length', 'max' => 18),
            array('telephone, debt_money, pay_money', 'length', 'max' => 20),
            array('account_number', 'length', 'max' => 50),
            array('others', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, docsId, clientele, debtor, ID_number, telephone, account_number, debt_money, pay_money, ifpay, others, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'docsId' => 'Docs',
            'clientele' => '委托人',
            'debtor' => '欠债人',
            'ID_number' => '欠债人身份证号码',
            'telephone' => '电话号码',
            'account_number' => '账号编号',
            'debt_money' => '欠费金额',
            'pay_money' => '缴费金额',
            'ifpay' => '是否缴费完整',
            'others' => '其他',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('docsId', $this->docsId);
        $criteria->compare('clientele', $this->clientele, true);
        $criteria->compare('debtor', $this->debtor, true);
        $criteria->compare('ID_number', $this->ID_number, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('account_number', $this->account_number, true);
        $criteria->compare('debt_money', $this->debt_money, true);
        $criteria->compare('pay_money', $this->pay_money, true);
        $criteria->compare('ifpay', $this->ifpay);
        $criteria->compare('others', $this->others, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Debts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
