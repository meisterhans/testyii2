<?php

namespace common\models;

use Yii;
use common\models\EmployeesGroup;
use common\models\EmployeesSkill;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $surname
 * @property int $in_place
 */
class Employees extends \yii\db\ActiveRecord
{
    public $group_id;
    public $skill_id;

    const OUT_OF_PLACE = 0;
    const IN_PLACE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'in_place'], 'required'],
            [['in_place'], 'integer'],
            [['surname'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'in_place' => 'Статус',
            'groups' => 'Группа',
            'skills' => 'Навыки'
        ];
    }

    public function inPlaceStatus()
    {
        return [
            self::OUT_OF_PLACE => "Не на месте",
            self::IN_PLACE => "На месте"
        ];
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->hasMany(EmployeesGroup::className(), ['employee_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->hasMany(EmployeesSkill::className(), ['employee_id' => 'id']);
    }

    /**
     * @return array
     */
    public function employeeGroups()
    {
        return ArrayHelper::map($this->getGroups()->joinWith('group')->all(), 'id', 'group.name');
    }

    /**
     * @return array
     */
    public function employeeSkills()
    {
        return ArrayHelper::map($this->getSkills()->joinWith('skill')->all(), 'id', 'skill.name');
    }
}
