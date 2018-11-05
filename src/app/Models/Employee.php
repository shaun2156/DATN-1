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
        return self::hasMany(EmployeeRoleAccess::class, 'employee_id', 'employee_id');
    }

    public function person()
    {
        return self::belongsTo(Person::class, 'person_id');
    }
}
