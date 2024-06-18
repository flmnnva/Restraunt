<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property int $id
 * @property int $users_id
 * @property int $table_id
 * @property string $date
 * @property string $time
 * @property int $status_id
 *
 * @property Status $status
 * @property Tables $table
 * @property users $users
 */
class Bookings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['users_id', 'table_id', 'date', 'time', 'status_id'], 'required'],
            [['users_id', 'table_id', 'status_id'], 'integer'],
            [['date', 'time'], 'safe'],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::class, 'targetAttribute' => ['table_id' => 'id']],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => users::class, 'targetAttribute' => ['users_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => 'users ID',
            'table_id' => 'Table ID',
            'date' => 'Date',
            'time' => 'Time',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Table]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Tables::class, ['id' => 'table_id']);
    }

    /**
     * Gets query for [[users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getusers()
    {
        return $this->hasOne(users::class, ['id' => 'users_id']);
    }
}
