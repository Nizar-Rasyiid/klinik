<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 *
 * @property Pendaftaran[] $pendaftarans
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'telepon'], 'required'],
            [['alamat'], 'string'],
            [['nama'], 'string', 'max' => 100],
            [['telepon'], 'string', 'max' => 15],
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
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
        ];
    }

    /**
     * Gets query for [[Pendaftarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, ['pasien_id' => 'id']);
    }
    public function getTindakans()
    {
        return $this->hasMany(Tindakan::className(), ['id_pasien' => 'id']);
    }
}
