<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = "works";
    protected $fillable = [
        "user_id", "progress_id", "complexity_id",
        "name", "description", "time", "dead_line"
    ];

    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function progress(){
        return $this->belongsTo("App\Progress", "progress_id");
    }

    public function complexity(){
        return $this->belongsTo("App\Complexity", "complexity_id");
    }
}
