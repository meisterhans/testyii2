<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employees_skill".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $skill_id
 */
class EmployeesSkill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'skill_id'], 'required'],
            [['employee_id', 'skill_id'], 'integer'],
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
            'skill_id' => 'Skill ID',
        ];
    }

    /**
     * @return mixed
     */
    public function getSkill()
    {
        return $this->hasOne(Skills::className(), ['id' => 'skill_id']);
    }
}
