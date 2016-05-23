<?php

/**
 * This is the model class for table "gz_upload_docs".
 *
 * The followings are the available columns in table 'gz_upload_docs':
 * @property integer $id
 * @property string $uploader
 * @property integer $time
 * @property string $detail
 */
class UploadDocs extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'gz_upload_docs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uploader,time,type,upload_name,starttime,endtime,area,comments', 'required'),
            array('time', 'numerical', 'integerOnly' => true),
            array('uploader', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uploader, time, detail,type,upload_name,showDetail,label,information', 'safe', 'on' => 'search'),
            array('endtime', 'compare', 'compareAttribute' => 'starttime', 'operator' => '>=', 'message' => '起止时间不对')
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
            'upload_name' => '文件名字',
            'uploader' => 'Uploader',
            'detail' => '文件',
            'type' => '欠费类型',
            'starttime' => '欠费开始时间',
            'endtime' => '欠费结束时间',
            'area' => '欠费区域',
            'comments' => '备注',
            'pay_nums' => '缴费人数',
            'pay_totalmoney' => '缴费总额',
            'progress'=>'完成进度'
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
        $criteria->compare('uploader', $this->uploader, true);
        $criteria->compare('starttime', $this->starttime);
        $criteria->compare('endtime', $this->endtime);
        $criteria->compare('detail', $this->detail, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UploadDocs the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
