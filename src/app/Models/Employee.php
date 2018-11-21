<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeRoleAccess;
use App\Models\Person;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';

    public function employeeRoles()
    {
        return $this->hasMany(EmployeeRoleAccess::class, 'employee_id', 'employee_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function hasRole($role)
    {
        $roleConfig = require(__DIR__ . '/../../config/roles.php');
        $checkRole = $this->query()
            ->join('employee_role_access', 'employee.employee_id', '=', 'employee_role_access.employee_id')
            ->where('employee_role_access.role_id', $roleConfig[$role])
            ->where('employee_role_access.employee_id', $this->employee_id)
            ->get();

        return count($checkRole) !== 0;
    }
}
