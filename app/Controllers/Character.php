<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Character extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $apiUrl = "https://swapi.dev/api/people/?page={$page}";
        
        $client = \Config\Services::curlrequest();
        $options = [
            'verify'  => false,
            'timeout' => 30,
        ];
        $response = $client->get($apiUrl, $options);

        
        if ($response->getStatusCode() == 200) {
            $characters = json_decode($response->getBody(), true);
            
            $data = [
                'characters' => $characters['results'],
                'current_page' => $page,
                'next_page' => isset($characters['next']) ? $page + 1 : null,
                'prev_page' => isset($characters['previous']) ? $page - 1 : null,
                'total_pages' => ceil($characters['count'] / 10), 
            ];
            
            return view('characters/index', $data);
        } else {
            return view('characters/index', ['error' => 'Failed to fetch characters']);
        }
    }

    public function show($id)
    {
        // sanitize the id
        $id = (int)$id;
        // Fetch character details from the API
        $apiUrl = "https://swapi.dev/api/people/{$id}/";
        
        $client = \Config\Services::curlrequest();
        $options = [
            'verify'  => false,
            'timeout' => 30,
        ];
        $response = $client->get($apiUrl, $options);

        
        if ($response->getStatusCode() == 200) {
            $character = json_decode($response->getBody(), true);
            $character['id'] = $id; 
            $character['exists'] = $this->UserCharacterExists($id); 
            return view('characters/show', ['character' => $character]);
        } else {
            return view('characters/index', ['error' => 'Failed to fetch character']);
        }
    }

    private function UserCharacterExists($id) 
    {
        // sanitize the id
        $id = (int) $id;

        $userId = auth()->user()->id;
        $character = model('UserCharacter')->where('user_id', $userId)
                         ->where('character_id', $id)
                         ->first();

        return $character ? true : false;
    }
}
