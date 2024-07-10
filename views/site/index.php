<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

// Ambil data transaksi
$dataProvider = new ActiveDataProvider([
    'query' => Transaksi::find()
        ->select(['MONTHNAME(created_at) as bulan', 'SUM(total_biaya) as total'])
        ->groupBy(['MONTHNAME(created_at)'])
]);

// Ambil data dalam bentuk array
$data = $dataProvider->getModels();

// Buat array untuk menyimpan total biaya transaksi per bulan
$labels = [];
$totalBiaya = [];

foreach ($data as $row) {
    $labels[] = $row['created_at'];
    $totalBiaya[] = (int) $row['total_biaya'];
}
$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome to Your Sistem Informasi Klinik</h1>

        <p class="lead">Manage your clinic efficiently with our application.</p>

        <?= ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 200,
            ],
            'clientOptions' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                            ],
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Total Biaya (Rp)',
                            ],
                        ],
                    ],
                ],
            ],
            'data' => [
                'labels' => $labels, // Label bulan
                'datasets' => [
                    [
                        'label' => 'Total Biaya Transaksi',
                        'backgroundColor' => "rgba(179,181,198,0.2)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => $totalBiaya, // Data total biaya
                    ],
                ],
            ],
        ]) ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Wilayah</h2>
                <p>Manage regions and locations.</p>
                <p><?= Html::a('Go to Wilayah', ['/wilayah/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Pegawai</h2>
                <p>Manage employees.</p>
                <p><?= Html::a('Go to Pegawai', ['/pegawai/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Obat</h2>
                <p>Manage medicines.</p>
                <p><?= Html::a('Go to Obat', ['/obat/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Tindakan</h2>
                <p>Manage treatments.</p>
                <p><?= Html::a('Go to Tindakan', ['/tindakan/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Pembayaran</h2>
                <p>Manage payments.</p>
                <p><?= Html::a('Go to Pembayaran', ['/pembayaran/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Transaksi</h2>
                <p>Manage transactions.</p>
                <p><?= Html::a('Go to Transaksi', ['/transaksi/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Pendaftaran</h2>
                <p>Manage registrations.</p>
                <p><?= Html::a('Go to Pendaftaran', ['/pasien/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
        </div>

    </div>
</div>
