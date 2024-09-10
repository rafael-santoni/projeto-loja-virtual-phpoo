<?php

namespace App\Models\Site;

use App\Models\Model;
use App\Interfaces\InterfaceLogin;

class UserLogin extends Model implements InterfaceLogin {

    public $table = 'users';

}
