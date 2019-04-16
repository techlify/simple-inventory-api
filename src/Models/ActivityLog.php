<?php
namespace TechlifyInc\LaravelModelLogger\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

    protected $table = "model_logging_activity_logs";
    protected $casts = [
        "object" => "array",
        "data"   => "array"
    ];

}
