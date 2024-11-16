<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class test extends TestCase {
    private $client;

    protected function setUp(): void {
        // Correctly assign the client
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000/api/', // Base URL
            'http_errors' => false
        ]);
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }

    public function completeFlowTest() {
        // Create user1
        $response = $this->client->post('users', [
            'json' => ['username' => 'test-user1']
        ]);
        echo $response->getBody();

        // Assert that the response status code is 200
        $this->assertEquals(200, $response->getStatusCode());
        if($response->getStatusCode() == 200){
            echo "User Created Successfully";
        }
        else{
            echo "User Creation Failed";
            echo $response->getBody()->getContents();
        }

        // Create user2
        $response = $this->client->post('users', [
            'json' => ['username' => 'test-user2']
        ]);
        echo $response->getBody();

        // Assert that the response status code is 200
        $this->assertEquals(200, $response->getStatusCode());
        if($response->getStatusCode() == 200){
            echo "User Created Successfully";
        }
        else{
            echo "User Creation Failed";
            echo $response->getBody()->getContents();
        }
        
        
      

    }
}