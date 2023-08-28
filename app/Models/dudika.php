<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dudika extends Model
{
    use HasFactory;
    protected $fillable =[
        'pemimpin','nama','jabatan','umur','alamat'
    ];
}
