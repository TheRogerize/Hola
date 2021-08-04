<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  public function testValidLoginInput()
  {
    require './src/models/user.php';
    require './config/database.php';

    $database = new Database();
    $db = $database->connect();

    $username = '';
    $password = '';

    $user = new User($db, $username, $password);

    $errorExpected = 'Please, insert your credentials.';
    $auth = $user->authUser();
    $auth = (array) json_decode($auth);
    $this->assertEquals($errorExpected, $auth['message']);
    $this->assertEquals(false, $auth['success']);
  }

  public function testExistentUser()
  {

    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'http://localhost/PHP-test-finish/src/controllers/createUser.php', [
      'form_params' => [
        'name' => 'roy',
        'username' => 'roy123',
        'password' => 'admin',
        'role' => 'ADMIN'
      ]
    ]);

    $errorExpected = 'This user already exists.';
    $contents = $response->getBody()->getContents();
    $responseMessage = (array) json_decode($contents);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($errorExpected, $responseMessage['message']);
    $this->assertEquals(false, $responseMessage['success']);
  }

  public function testEmptyNewUser()
  {

    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'http://localhost/PHP-test-finish/src/controllers/createUser.php', [
      'form_params' => [
      ]
    ]);
    $contents = $response->getBody()->getContents();
    $errorExpected = 'The user could not be created because there is missing data.';
    $responseMessage = (array) json_decode($contents);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($errorExpected, $responseMessage['message']);
    $this->assertEquals(false, $responseMessage['success']);
  }

  public function testUpdateUser()
  {

    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'http://localhost/PHP-test-finish/src/controllers/updateUser.php');
    $contents = $response->getBody()->getContents();
    $errorExpected = "The user could not be updated because there is missing data.";
    $responseMessage = (array) json_decode($contents);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($errorExpected, $responseMessage['message']);
    $this->assertEquals(false, $responseMessage['success']);
  }

  public function testDeleteUser()
  {

    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'http://localhost/PHP-test-finish/src/controllers/deleteUser.php');
    $contents = $response->getBody()->getContents();
    $errorExpected = "You haven't selected any user.";
    $responseMessage = (array) json_decode($contents);
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($errorExpected, $responseMessage['message']);
    $this->assertEquals(false, $responseMessage['success']);
  }
  
  // fwrite(STDERR, print_r( $auth, TRUE));
}
