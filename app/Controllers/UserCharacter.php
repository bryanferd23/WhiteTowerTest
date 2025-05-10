<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserCharacter extends BaseController
{
    public function index()
    {
        $userId = auth()->user()->id;
        $page = $this->request->getVar('page') ?? 1;
        
        // Fetch user's characters with pagination
        $total = model('UserCharacter')->where('user_id', $userId)->countAllResults();
        $perPage = 10;
        
        $characters = model('UserCharacter')->where('user_id', $userId)
                                    ->limit($perPage, ($page - 1) * $perPage)
                                    ->find();
        
        $data = [
            'characters' => $characters,
            'current_page' => $page,
            'next_page' => ($page * $perPage < $total) ? $page + 1 : null,
            'prev_page' => ($page > 1) ? $page - 1 : null,
            'total_pages' => ceil($total / $perPage),
        ];
        return view('UserCharacters/index', $data);
    }

    public function create($id)
    {
        // sanitize the id
        $id = (int)$id;
        $userId = auth()->user()->id;
        // check first if the character already exists
        $exists = $this->UserCharacterExists($id);

        if ($exists) {
            return redirect()->back()->with('error', 'Character already added.');
        }

        // Get source and page from form
        $source = $this->request->getPost('source') ?? 'main';
        $page   = $this->request->getPost('page') ?? '1';

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
        } else {
            return redirect()->back()->with('error', 'Failed to fetch character details.');
        }

        $data = [
            'character_id' => $id,
            'name' => $character['name'],
            'height' => $character['height'],
            'hair_color' => $character['hair_color'],
            'gender' => $character['gender'],
            'user_id' => $userId,
        ];


        if (model('UserCharacter')->save($data)) {
            // Redirect based on the source and page
            if ($source === 'saved') {
                return redirect()->to('user/characters?page=' . $page)->with('message', 'Character saved for later use.');
            } else {
                return redirect()->to('characters?page=' . $page)->with('message', 'Character saved for later use.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to save character.');
        }
    }

    public function delete($id)
    {
        // sanitize the id
        $id = (int) $id;

        $exists = $this->UserCharacterExists($id);

        if (!$exists) {
            return redirect()->back()->with('error', 'Character does not exist in your list.');
        }

        // Get source and page from form
        $source = $this->request->getPost('source') ?? 'main';
        $page   = $this->request->getPost('page') ?? '1';

        $userId = auth()->user()->id;
        if (model('UserCharacter')->where('user_id', $userId)->where('character_id', $id)->delete()) {
            // Redirect based on source
            if ($source === 'saved') {
                return redirect()->to('user/characters?page=' . $page)->with('message', 'Character deleted from saved list.');
            } else {
                return redirect()->to('characters?page=' . $page)->with('message', 'Character deleted from saved list.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to delete character.');
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
