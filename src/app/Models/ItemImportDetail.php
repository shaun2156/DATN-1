<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemImport;

class ItemImportDetail extends Model
{
    protected $table = 'item_import_detail';
    protected $primaryKey = 'item_import_detail_id';

    protected $fillable = [
        'color',
        'cost',
        'item_id',
        'quantity',
        'size',
        'item_import_id',
        'created_by',
        'updated_by',
    ];

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function itemImport()
    {
        return $this->belongsTo(ItemImport::class, 'item_import_id', 'item_import_id');
    }
}
