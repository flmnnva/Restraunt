<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $role
 *
 * @property users[] $users
 */
class Roles extends \yii\db\ActiveRecord
{
    const ADMIN_ROLE_ID=1;
    const users_ROLE_ID=2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'required'],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getusers()
    {
        return $this->hasMany(users::class, ['role_id' => 'id']);
    }
}
