<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WorksSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Works', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
            'attribute' => 'category',
            'value' => 'categoryId.name',
            ],
            'name',
            'text:ntext',
            [
            'attribute' => 'date',
            'format' => ['date', 'dd.MM.yyyy']
            ],
            //'image',
            'SmallImage:image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
