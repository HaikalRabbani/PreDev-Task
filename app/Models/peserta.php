<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = ['nama', 'alamat', 'jk'];
}
