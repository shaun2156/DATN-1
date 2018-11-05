<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeRoleAccess;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';

    public function roleEmployees()
    {
        return self::hasMany(EmployeeRoleAccess::class, 'role_id', 'role_id');
    }
}
