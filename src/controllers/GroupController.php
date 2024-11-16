<?php

// namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require __DIR__ . '/../models/Group.php';
// require __DIR__ . '/../models/User.php';

class GroupController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createGroup(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $name = $data['name'];
        $userId = $data['user_id']; 
        try{
            // Create a new group
            $groupModel = new Group($this->db);
            $groupId = $groupModel->createGroup($name, $userId);

        
            // Add the user to the group
            $groupModel->joinGroup($groupId, $userId);
            $response->getBody()->write(json_encode([
                'group_id' => $groupId,
                'message' => 'Group created and user added successfully'
            ]));
            return $response->withHeader('Content-Type', 'application/json');

        } catch (\Exception $e) {
            // Handle error if user is not in the group
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }



    
    
    public function joinGroup(Request $request, Response $response, array $args) {
       
        $data = $request->getParsedBody();
        $groupId = $data['id'];
        $userId = $data['user_id'];
        try{
            $groupModel = new Group($this->db);
            $result = $groupModel->joinGroup($groupId, $userId);

            $response->getBody()->write(json_encode(['message' => 'User joined the group successfully']));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            // Handle error if user is not in the group
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }

    public function getAllGroups(Request $request, Response $response, array $args) {
        try{
            // Create an instance of the Group model
            $groupModel = new Group($this->db);
            
            // Fetch all groups from the database
            $groups = $groupModel->getAllGroups(); // Assuming this method exists in your Group model
        
            // Check if groups were found
            if (empty($groups)) {
                $response->getBody()->write(json_encode(['message' => 'No groups found.']));
            } else {
                $response->getBody()->write(json_encode(['groups' => $groups]));
            }
        
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            // Handle error if user is not in the group
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }   
}
