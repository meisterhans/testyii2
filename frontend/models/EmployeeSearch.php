<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employees;

/**
 * Class ImportantNewsSearch
 * @package backend\models
 */
class EmployeeSearch extends Employees
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_place', 'group_id', 'skill_id'], 'integer'],

            [['surname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if(Yii::$app->request->post()){
            $params = Yii::$app->request->post();
        }

        $query = Employees::find()->joinWith('groups')->joinWith('skills');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'in_place' => $this->in_place,
            'employees_group.group_id' => $this->group_id,
            'employees_skill.skill_id' => $this->skill_id
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname]);

        return $dataProvider;
    }
}
