<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "obat".
 *
 * @property int $id
 * @property string $nama
 * @property int $stok
 * @property float $harga
 *
 * @property Transaksi[] $transaksis
 */
class Obat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'stok', 'harga'], 'required'],
            [['stok'], 'integer'],
            [['harga'], 'number'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'stok' => 'Stok',
            'harga' => 'Harga',
        ];
    }

    /**
     * Gets query for [[Transaksis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::class, ['obat_id' => 'id']);
    }
    public function getTindakans()
    {
        return $this->hasMany(Tindakan::className(), ['obat_id' => 'id']);
    }
}
