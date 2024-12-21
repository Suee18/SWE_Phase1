<?php
require_once __DIR__ . '/../models/UsersClass.php';
use PHPUnit\Framework\TestCase;

class UserTests extends TestCase
{
    public function testUserCanBeCreated()
    {
        $user = new Users('Fady', '17/02/2005', 'male', 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $this->assertInstanceOf(Users::class, $user);
    }

    public function testUserHasName()
    {
        $user = new Users('Fady', '17/02/2005', 'male', 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setUsername('John Doe');
        $this->assertEquals('John Doe', $user->getUsername());
    }

}