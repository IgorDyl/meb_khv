<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Works */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="works-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'], 
    ]); ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?=    FileInput::widget([
    'name' => 'Images[attachment]',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/site/save-img']),
        'uploadExtraData' => [
            'Images[class]' => $model->formName(),
            'Images[item_id]' => $model->id
        ],
        'maxFileCount' => 10
    ]
]);
?>

</div>
