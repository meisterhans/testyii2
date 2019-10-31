<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employees_group".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $group_id
 */
class EmployeesGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'group_id'], 'required'],
            [['employee_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
}
