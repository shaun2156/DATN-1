<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class CategoryEditing extends Model
{
    protected $table = 'category_editing';
    protected $fillable = [
        'created_by',
        'category_id',
        'parent_category_id',
        'old_description',
        'old_name',
        'old_parent_category_id',
        'remarks',
        'updated_by'
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    protected $primaryKey = 'category_editing_id';
}
