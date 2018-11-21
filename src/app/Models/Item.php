<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Category;
use App\Models\ItemImport;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'created_by',
        'updated_by',
        'current_price',
        'featured',
        'original_price',
        'short_description',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function itemImports()
    {
        return $this->hasMany(ItemImport::class, 'item_id', 'item_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'employee_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updated_by', 'employee_id');
    }
}
