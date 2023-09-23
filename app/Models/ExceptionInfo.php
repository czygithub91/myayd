<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExceptionInfo extends Model
{
    use SoftDeletes;

    protected $table = "exception_info";

    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'message',
        'code',
        'file',
        'line',
        'trace_str'
    ];
}
