<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Employees;
use yii\helpers\ArrayHelper;
use common\models\Groups;
use common\models\Skills;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-body table-responsive no-padding">
            <?php Pjax::begin(['clientOptions' => ['method' => 'POST']]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => "",
                'tableOptions' => ['class' => 'table table-bordered table-hover functions-table'],
                'filterModel' => $searchModel,
                'columns' => [
                    'surname',
                    [
                        'attribute' => 'in_place',
                        'value' => function($data){
                            $statuses = Employees::inPlaceStatus();
                            return $statuses[$data->in_place];
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'in_place', Employees::inPlaceStatus(), ['class'=>'form-control','prompt' => ''])
                    ],
                    [
                        'attribute' => 'groups',
                        'value' => function($data){
                            $result = $data->employeeGroups();

                            return implode(",", $result);
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'group_id', ArrayHelper::map(Groups::groupsList(), 'id', 'name'), ['class'=>'form-control','prompt' => ''])
                    ],
                    [
                        'attribute' => 'skills',
                        'value' => function($data){
                            $result = $data->employeeSkills();
                            
                            return implode(",", $result);
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'skill_id', ArrayHelper::map(Skills::skillsList(), 'id', 'name'), ['class'=>'form-control','prompt' => ''])
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>