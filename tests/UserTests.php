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
    
    public function testUserHasEmail()
    {
        $user = new Users('Fady', '17/02/2005', 'male', 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setEmail('fady@gmail.com');
        $this->assertEquals('fady@gmail.com', $user->getEmail());
    }
    
    public function testUserHasGender()
    {
        $user = new Users('Fady', '17/02/2005', "female" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setGender("male");
        $this->assertEquals("male", $user->getGender());
    }
    
    public function testUserHasPassword()
    {
        $user = new Users('Fady', '17/02/2005', "male" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setPassword('fady123');
        $this->assertEquals('fady123', $user->getPassword());        
    }

    public function testUserHasDateOfBirth()
    {
        $user = new Users('Fady', '17/02/2005', "male" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setBirthdate('17/02/2005');
        $this->assertEquals('17/02/2005', $user->getBirthdate());
    }

    public function testUserHasLoginMethod(){
        $user = new Users('Fady', '17/02/2005', "male" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setLoginMethod('google');
        $this->assertEquals('google', $user->getLoginMethod());
    }

    public function testUserHasPersonaID(){
        $user = new Users('Fady', '17/02/2005', "male" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setPersonaID(2);
        $this->assertEquals(2, $user->getPersonaID());
    }

    public function testUserLoginCounter() {
        $user = new Users('Fady', '17/02/2005', "male" , 'fady123456', 'fadyn2005@gmail.com', 1, 'manual', null, 5, new DateTime());
        $user->setLoginCounter(6);
        $this->assertEquals(6, $user->getLoginCounter());
    }
}