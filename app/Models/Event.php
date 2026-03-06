<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    public $timestamps = false;

    protected $fillable = ['nama_event', 'deskripsi', 'tanggal', 'lokasi', 'status'];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'event_id');
    }
}