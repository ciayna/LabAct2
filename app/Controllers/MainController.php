<?php

namespace App\Controllers;

class MainController extends BaseController
{
    private $music;
    private $playlist;

    public function __construct()
    {
        $this->music = new \App\Models\MainModel;
        $this->playlist = new \App\Models\PlaylistModel;        
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
        
    }

    public function index() 
    {
        $allAudio = $this->music->findAll(); 

        return view('main', ['allAudio' => $allAudio]);
    }
}

