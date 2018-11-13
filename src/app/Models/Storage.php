<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\ItemImport;

class Storage extends Model
{
    protected $table = 'storage';
    protected $primaryKey = 'storage_id';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'address',
        'manager_id',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'employee_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'employee_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by', 'employee_id');
    }

    public function itemImports()
    {
        return $this->hasMany(ItemImport::class, 'storage_id', 'storage_id');
    }
}
