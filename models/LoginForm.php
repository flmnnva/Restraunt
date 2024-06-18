<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read users|null $users
 *
 */
class LoginForm extends Model
{
    public $usersname;
    public $password;
    public $rememberMe = true;

    private $_users = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // usersname and password are both required
            [['usersname', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $users = $this->getusers();

            if (!$users || !$users->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect usersname or password.');
            }
        }
    }

    /**
     * Logs in a users using the provided usersname and password.
     * @return bool whether the users is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $users= $this->getusers();
            if ($users){
            return Yii::$app->users->login($users, $this->rememberMe ? 3600*24*30 : 0);
        }
    }
    $this->addError('password', 'Incorrect usersname or password.');
        return false;
    }

    /**
     * Finds users by [[usersname]]
     *
     * @return users|null
     */
    public function getusers()
    {
        if ($this->_users === false) {
            $this->_users = users::login($this->usersname, $this->password);
        }

        return $this->_users;
    }
}
