<?php
use \PHPUnit\Framework\TestCase;
use login_unittest\classes\User;

// Filename moet gelijk zijn aan de classname LoginTest
class LoginTest extends TestCase
{
    protected $user;

    // Create object User for all tests
protected function setUp(): void

{
    $this->user = new User();
}
// Methods moeten starten met de naam test..

// test password
public function testSetAndGetPassword()
{
    $password = "password123";
    $this->user->SetPassword($password);
    $this->assertEquals($password, $this->user->GetPassword());
}

// test of username leeg is
public function testValidateUserWithEmptyUsername()
{
    $this->user->SetPassword("password123");
    $errors = $this->user->ValidateUser();
    $this->assertContains("Invalid username", $errors);
}

// test of wachtwoord leeg is
public function testValidateUserWithEmptyPassword()
{
    $this->user->username = "jan_smit";
    $errors = $this->user->ValidateUser();
    $this->assertContains("Invalid password", $errors);
}

// test of die ingelogged is
public function testIsLoggedin_notset(){
    $this->user->Logout();
    $this->assertFalse($this->user->IsLoggedin());
}

// test of er een session start
public function testIsLoggedin_set(){
    session_start();
    $_SESSION['user'] = "test";
    $this->assertFalse($this->user->IsLoggedin());
}

public function testLogout()
{
    // Test logout functionality if any
    session_start();
    $this->user->Logout();
    // Check if session is deleted
    $isDeleted = (session_status() == PHP_SESSION_NONE || empty (session_id()));
    $this->assertTrue($isDeleted);
}

}
?>