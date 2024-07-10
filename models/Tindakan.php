<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tindakan".
 *
 * @property int $id
 * @property string $nama_pasien
 * @property string $keluhan
 * @property int $id_obat
 *
 * @property Obat $obat
 */
class Tindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'keluhan', 'id_obat','id_pasien'], 'required'],
            [['keluhan'], 'string'],
            [['nama_pasien'], 'string', 'max' => 100],
            [['id_obat'], 'integer'],
            [['id_pasien'], 'integer'],
            [['id_obat'], 'exist', 'skipOnError' => true, 'targetClass' => Obat::className(), 'targetAttribute' => ['id_obat' => 'id']],
            [['id_pasien'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::className(), 'targetAttribute' => ['id_pasien' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pasien' => 'Nama Pasien',
            'keluhan' => 'Keluhan',
            'id_obat' => 'Obat',
            'id_pasien' => 'Pasien',

        ];
    }

    /**
     * Gets query for [[Obat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'id_obat']);
    }
    public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['id' => 'id_pasien']);
    }
}
