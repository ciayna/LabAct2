<?php

namespace App\Controllers;

class MainController extends BaseController
{
    private $music;
    private $playlist;
    private $playliaud;

    public function __construct()
    {
        $this->music = new \App\Models\MainModel;
        $this->playlist = new \App\Models\PlaylistModel;   
        $this->playliaud = new \App\Models\PlayliAudModel;      
    }

    public function addAudio()
    {
        if ($file = $this->request->getFile('audio')) {
            $destination = './music';
            $file->move($destination);
            $audioFileName = $file->getName();
            $newAudio = [
                'audio' => $audioFileName,
            ];
            $this->music->insert($newAudio);
        }
        return redirect()->to('/main');
    }    

    public function addPlaylist() 
    {
        $addPlaylist = [
            'playlistName' => $this->request->getPost('playlistName'),
        ];
        if (!empty($addPlaylist['playlistName'])) 
        {
            $this->playlist->insert($addPlaylist);
        }
        return redirect()->to('/main');
    }

    public function delete($playlistId)
    {
        $this->playlist->delete($playlistId);
        return redirect()->to('/main');
    }

    public function index() 
    {
        $data = [
            'allAudio' => $this->music->findAll(),
            'playlists' => $this->playlist->findAll(),
        ];
        
        $data['music'] = $this->playlist->findAll();
        $data['playlist'] = $this->music->findAll(); 

        return view('main', $data);
    }
}

