<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Obat; // Pastikan model Obat telah diimport
use app\models\Pasien; // Pastikan model Obat telah diimport

/** @var yii\web\View $this */
/** @var app\models\Tindakan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tindakan-form">

    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'id_pasien')->dropDownList(
        \yii\helpers\ArrayHelper::map(Pasien::find()->all(), 'id', 'nama'),
        ['prompt' => 'Pilih Pasien']
    ) ?>

    <?= $form->field($model, 'keluhan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_obat')->dropDownList(
        \yii\helpers\ArrayHelper::map(Obat::find()->all(), 'id', 'nama'),
        ['prompt' => 'Pilih Obat']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
