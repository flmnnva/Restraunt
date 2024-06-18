<?php

namespace tests\unit\models;

use app\models\users;

class usersTest extends \Codeception\Test\Unit
{
    public function testFindusersById()
    {
        verify($users = users::findIdentity(100))->notEmpty();
        verify($users->usersname)->equals('admin');

        verify(users::findIdentity(999))->empty();
    }

    public function testFindusersByAccessToken()
    {
        verify($users = users::findIdentityByAccessToken('100-token'))->notEmpty();
        verify($users->usersname)->equals('admin');

        verify(users::findIdentityByAccessToken('non-existing'))->empty();        
    }

    public function testFindusersByusersname()
    {
        verify($users = users::findByusersname('admin'))->notEmpty();
        verify(users::findByusersname('not-admin'))->empty();
    }

    /**
     * @depends testFindusersByusersname
     */
    public function testValidateusers()
    {
        $users = users::findByusersname('admin');
        verify($users->validateAuthKey('test100key'))->notEmpty();
        verify($users->validateAuthKey('test102key'))->empty();

        verify($users->validatePassword('admin'))->notEmpty();
        verify($users->validatePassword('123456'))->empty();        
    }

}
