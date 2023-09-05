<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tin extends Model
{
    public $timestamps = true;

    protected $table = 'tbl_tin';
    public $primaryKey = 'id';
    protected $dates = ['ngaydang'];
    protected $fillable = [
        'tieude',
        'tomtat',
        'noidung',
        'ngaydang',
        'luotxem',
        'img',
        'idlt',
    ];

    public function lichSuXemTin()
    {
        return $this->hasMany(LichSuXemTin::class, 'idnew');
    }

    // use HasFactory;
}
