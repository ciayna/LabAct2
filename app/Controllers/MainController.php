<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public $music;

    public function __construct()
    {
        $this->music = new \App\Models\MainModel;        
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

    public function index() 
    {
        $allAudio = $this->music->findAll(); 

        return view('main', ['allAudio' => $allAudio]);
    }
}

