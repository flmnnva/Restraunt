<?php

use app\models\Bookings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\BookingsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bookings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'users',
            'table_id',
            'date',
            'time',
            [
                'attribute'=>'status',
                'content'=>function($bookings){
                    $html=Html::beginForm(['update','id'=>$bookings->id]);
                    $html.=Html::activeDropDownlist($bookings, 'status_id',
                    [
                        2 => 'Подтверждена',
                        3 => 'Отклонена'
                    ],
                    ['promt'=>[
                        'text'=>'Новая',
                        'options'=>[
                            'style'=>'display::none'
                        ]
                    ]
                ]
                        );
                    $html.= Html::submitButton('Подтвердить',
                ['class'=>'btn btn-link']);
                    $html.= Html::endForm();
                    return $html;
                }
            ],
        ],
    ]); 
    ?>
    <?php Pjax::end(); ?>

</div>
