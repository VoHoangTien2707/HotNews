<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuXemTin extends Model
{
    protected $table = 'tbl_LichSuXemTin';

    protected $fillable = ['iduser', 'idnew', 'thoigianxem'];

    use HasFactory;

    public function tinTuc()
    {
        return $this->belongsTo(tin::class, 'idnew');
    }
}
