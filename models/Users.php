<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property int $role_id
 *
 * @property Bookings[] $bookings
 * @property Roles $role
 */
class users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{   public function __toString(){
    return $this->login;
}
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'password', 'roles_id'], 'required'],
            [['role_id'], 'integer'],
            [['name', 'surname', 'email', 'password'], 'string', 'max' => 255],
            ['email','email'],
            [['roles_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::class, 'targetAttribute' => ['roles_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'password' => 'Password',
            'roles_id' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Bookings::class, ['users_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::class, ['id' => 'roles_id']);
    }
    public static function getInstance(){
        return Yii::$app->users->identity;
    }
    public static function login($login, $password){
        $users = static::find()->where(['login'=>$login])->one();
        if ($users && $users ->validatePassword($password)){
            return $users;
        }
        return null;
    }
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::find()->where(['id'=>$id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds users by usersname
     *
     * @param string $usersname
     * @return static|null
     */
    public static function findByusersname($usersname)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }
    public function isAdmin(){
        return $this->roles_id==Roles::ADMIN_ROLE_ID;
    }
}
