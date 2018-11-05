<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Role;

class EmployeeRoleAccess extends Model
{
    protected $table = 'employee_role_access';

    public function employee()
    {
        return self::belongsTo(Employee::class, 'employee_id');
    }

    public function role()
    {
        return self::belongsTo(Role::class, 'role_id');
    }
}
