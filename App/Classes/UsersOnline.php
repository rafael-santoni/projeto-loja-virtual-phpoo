<?php

namespace App\Classes;

use App\Models\Site\UsersOnlineModel;

class UsersOnline {

    private $usersOnlineModel;
    private $ip;

    public function __construct(){

        $this->usersOnlineModel = new UsersOnlineModel;
        $this->ip = $_SERVER['REMOTE_ADDR'];

    }

    public function userAlreadyOnline(){

        $user = $this->usersOnlineModel->find('ip', $this->ip);
        return ($user) ? true : false;

    }

    public function addUser(){

        if(!$this->userAlreadyOnline()) {
            return $this->usersOnlineModel->create([
                $this->ip,
                IdRandom(),
                date('Y-m-d H:i:s', strtotime('+10minutes'))
            ]);

        }

        return $this->usersOnlineModel->update(date('Y-m-d H:i:s', strtotime('+10minutes')), IdRandom());

    }

    public function run(){

        if($this->usersOnlineModel->remove()) {
            return;
        }

        $this->addUser();

    }

}
