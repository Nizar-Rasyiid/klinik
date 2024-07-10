<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property int $pasien_id
 * @property int|null $tindakan_id
 * @property int|null $obat_id
 * @property int|null $jumlah_obat
 * @property float|null $total_biaya
 *
 * @property Obat $obat
 * @property Pendaftaran $pasien
 * @property Pembayaran[] $pembayarans
 * @property Tindakan $tindakan
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pasien_id'], 'required'],
            [['pasien_id', 'tindakan_id', 'obat_id', 'jumlah_obat'], 'integer'],
            [['total_biaya'], 'number'],
            [['pasien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tindakan::class, 'targetAttribute' => ['pasien_id' => 'id_pasien']],
            [['tindakan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tindakan::class, 'targetAttribute' => ['tindakan_id' => 'id']],
            [['obat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tindakan::class, 'targetAttribute' => ['obat_id' => 'id_obat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_id' => 'Pasien ID',
            'tindakan_id' => 'Tindakan ID',
            'obat_id' => 'Obat ID',
            'jumlah_obat' => 'Jumlah Obat',
            'total_biaya' => 'Total Biaya',
        ];
    }

    /**
     * Gets query for [[Obat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObat()
    {
        return $this->hasOne(Obat::class, ['id' => 'obat_id']);
    }

    /**
     * Gets query for [[Pasien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(Pendaftaran::class, ['id' => 'pasien_id']);
    }

    /**
     * Gets query for [[Pembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPembayarans()
    {
        return $this->hasMany(Pembayaran::class, ['transaksi_id' => 'id']);
    }

    /**
     * Gets query for [[Tindakan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakan()
    {
        return $this->hasOne(Tindakan::class, ['id' => 'tindakan_id']);
    }
}
