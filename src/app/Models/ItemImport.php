<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Storage;
use App\Models\Supplier;

class ItemImport extends Model
{
    protected $table = 'item_importing';
    protected $primaryKey = 'importing_id';

    protected $fillable = [
        'item_id',
        'storage_id',
        'supplier_id',
        'created_by',
        'updated_by',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id', 'storage_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function itemImportDetails()
    {
        return $this->hasMany(ItemImportDetail::class, 'item_import_id', 'importing_id');
    }
}
