<?php

// namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use App\Models\Message;
require __DIR__ . '/../models/Message.php';

class MessageController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Send message
    public function sendMessage(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $groupId = $data['group_id'];
        $userId = $data['user_id'];
        $content = $data['content'];

        try {
            $messageModel = new Message($this->db);
            $result = $messageModel->sendMessage($groupId, $userId, $content);
            
            $response->getBody()->write(json_encode([
                'result' => $result,
                'message' => 'Message sent successfully'
            ]));
            
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            // Handle error if user is not in the group
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }

    
    // Get all messages for a group
     
    public function listMessages(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $groupId = $data['group_id'];
        try{
            $messageModel = new Message($this->db);
            $messages = $messageModel->getMessagesByGroup($groupId);

            $response->getBody()->write(json_encode(['messages' => $messages]));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
        
    }
}
