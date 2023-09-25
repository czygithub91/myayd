<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

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

    public function __construct()
    {
        $table = $this->table.'_'.Carbon::now()->format('Ymd');
        if (!Schema::hasTable($table)) {
            Schema::create($table, function ($table) {
                $table->increments('id');
                $table->string('uuid', 255);
                $table->string('method', 16);
                $table->string('path', 255);
                $table->text('request_data');
                $table->text('response_data');
                $table->timestamps();
            });
        }
    }
}
