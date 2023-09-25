<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

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


    public function __construct()
    {
        $table = $this->table.'_'.Carbon::now()->format('Ymd');
        if (!Schema::hasTable($table)) {
            Schema::create($table, function ($table) {
                $table->increments('id');
                $table->string('message', 255);
                $table->string('code', 255);
                $table->string('file', 255);
                $table->string('line', 255);
                $table->text('trace_str');
                $table->timestamps();
            });
        }
    }
}
