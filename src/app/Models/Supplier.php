<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'address',
        'manager_id',
        'contact_no',
        'description'
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'employee_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by', 'employee_id');
    }
}
