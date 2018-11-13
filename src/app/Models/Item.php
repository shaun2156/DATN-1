<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

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
}
