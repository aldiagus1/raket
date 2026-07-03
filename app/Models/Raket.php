<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Raket extends Model
{
protected $fillable = [
        'nama_raket', 
        'brand', 
        'deskripsi', 
        'gambar', 
        'power', 
        'control', 
        'speed', 
        'durability', 
        'flexibility'
    ];}
