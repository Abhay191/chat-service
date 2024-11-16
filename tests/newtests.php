<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class newtests extends TestCase {
    private $client;

    protected function setUp(): void {
        // Correctly assign the client
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000/api/', // Base URL
            'http_errors' => false
        ]);
        
    }

    public function testCompleteFlow() {
        $username1 = "TestUser-1";
        $username2 = "TestUser-2";
        $groupname = "TestGroup-1";
        // Create user1
        $response = $this->client->post('users', [
            'json' => ['username' => $username1]
        ]);
    
       
        $responseData = (string) $response->getBody();

        $data = json_decode($responseData, true);
        $userId1;
        // Check if 'user_id' exists in the decoded array
        if (isset($data['user_id'])) {
            // Convert the user_id to an integer
            $userId1 = (int)$data['user_id'];
            $message = $data['message'];
            echo "User ID: " . $userId1."\n";
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());


        // Create user2
        $response = $this->client->post('users', [
            'json' => ['username' => $username2]
        ]);
    
        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);
        // Check if 'user_id' exists in the decoded array
        $userId2;
        if (isset($data['user_id'])) {
            // Convert the user_id to an integer
            $userId2 = (int)$data['user_id'];
            $message = $data['message'];
            echo "User ID: " . $userId2."\n";
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());
       

        // Create Group 
        $response = $this->client->post('groups', [
            'json' => ['name' => $groupname,
            'user_id' => $userId1]
        ]);

        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);
        $groupId;
        if (isset($data['group_id'])) {
            // Convert the group_id to an integer
            $groupId = (int)$data['group_id'];
            $message = $data['message'];
            echo "Group ID: " . $groupId."\n";
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());
        

        // User2 Join Group1 //
        $response = $this->client->post('groups/join', [
            'json' => ['id' => $groupId,
            'user_id' => $userId2]
        ]);

        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);

        if (isset($data['message'])) {
            $message = $data['message'];
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());


        // User1 send message in Group1
        $response = $this->client->post('messages', [
            'json' => ['group_id' => $groupId,
            'user_id' => $userId1,
            'content' => 'Hello, from user1!'
            ]
        ]);

        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);

        if (isset($data['message'])) {
            $message = $data['message'];
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());


        // User2 send message in Group1
        $response = $this->client->post('messages', [
            'json' => ['group_id' => $groupId,
            'user_id' => $userId2,
            'content' => 'Hello, from user2!'
            ]
        ]);

        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);

        if (isset($data['message'])) {
            $message = $data['message'];
            echo "Message: " . $message."\n";
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());


        // List messages in group1
        $response = $this->client->get('messages/list', [
            'json' => [
                'group_id' => $groupId,
            ]
        ]);

        $responseData = (string) $response->getBody();
        
        $data = json_decode($responseData, true);

        if (isset($data['messages']) && is_array($data['messages'])) {
            echo "Messages in the group: \n";
            foreach ($data['messages'] as $message) {
                echo "------------------------\n";
                echo "ID: " . $message['id'] . "\n";
                echo "Message: " . $message['message'] . "\n";
                echo "Time: " . $message['time'] . "\n";
                echo "Username: " . $message['username'] . "\n";
                echo "------------------------\n";
            }
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());


        // List of all groups
        $response = $this->client->get('groups/list', [
        ]);

        $responseData = (string) $response->getBody();
        $data = json_decode($responseData, true);

        if (isset($data['groups']) && is_array($data['groups'])) {
            echo "Groups: \n";
            foreach ($data['groups'] as $group) {
                echo "------------------------\n";
                echo "ID: " . $group['id'] . "\n";
                echo "Name: " . $group['name'] . "\n";
                echo "Created At: " . $group['created_at'] . "\n";
                echo "------------------------\n";
            }
        } else {
            $error = $data['error'];
            echo $error . "\n";
        }

        $this->assertEquals(200, $response->getStatusCode());

    }
}