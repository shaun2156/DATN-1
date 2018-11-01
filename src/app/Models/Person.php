<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Person extends Model
{
    protected $table = 'person';
    protected $primaryKey = 'person_id';

    public function employee()
    {
        return $this->hasOne(Employee::class, 'person_id', 'person_id');
    }
}
