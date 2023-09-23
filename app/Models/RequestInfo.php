<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestInfo extends Model
{
    use SoftDeletes;
    protected $table = "request_info";

    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'uuid',
        'method',
        'path',
        'request_data',
        'response_data'
        ];
}
