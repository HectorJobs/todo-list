<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = "progress";
    protected $fillable = ["name"];

    public function work(){
        return $this->hasMany("App\Work");
    }
}
