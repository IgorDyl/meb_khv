<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Works */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'], 
    ]); ?>
<div class="nkevents-model-form">
    <div class="row">
        <div class="col-md-6">
            <h4>Основное</h4>
            <div class="card-box">

                <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(common\models\Category::find() ->all(), 'id', 'name'), ['prompt' => '--']) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="col-md-5">
            <h4>Изображения</h4>
                <div class="card-box">
                            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                        ]); ?>
                </div>
        </div>
        <div class="col-md-5">
            <h4>Дата и время</h4>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'date')->widget(
                                DatePicker::className(), [
                                    // inline too, not bad
                                    // 'inline' => true, 
                                    // modify template for custom rendering
                                    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd.mm.yyyy'
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
        </div>  
    </div>
</div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

<!-- <?=    FileInput::widget([
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
?> -->

</div>
