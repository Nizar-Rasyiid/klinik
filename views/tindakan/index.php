<?php

use app\models\Tindakan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TindakanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tindakan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tindakan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tindakan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute' => 'id_pasien',
                'value' => function ($model) {
                    if ($model->pasien) {
                        return $model->pasien->nama;
                    } else {
                        var_dump($model->pasien); // Tambahkan ini untuk debug
                        return 'Kosong'; // Atau ganti dengan pesan kesalahan atau nilai default jika tidak ada data
                    }
                }
            ],

            'keluhan',
            [
                'attribute' => 'nama_obat',
                'value' => function ($model) {
                    return $model->obat ? $model->obat->nama : '';
                }
            ],
            ['attribute'=>'biaya',
                'value' => function ($model) {
                    return $model->obat ? $model->obat->harga : '';
                }
        ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tindakan $model, $key, $index) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
