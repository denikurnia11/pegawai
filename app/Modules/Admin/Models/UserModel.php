<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['nama', 'email', 'password', 'role'];
}
