<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBahan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'stok_bahan';
}
