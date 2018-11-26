<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreConfig extends Model
{
    protected $table = 'store_config';
    protected $primaryKey = 'config_id';

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    
}
