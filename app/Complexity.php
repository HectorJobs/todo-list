<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complexity extends Model
{
    protected $table = "complexities";
    protected $fillable = ["name", "color"];

    public function work(){
        return $this->hasMany("App\Work");
    }
}
