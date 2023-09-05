<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'tbl_donhang';
    public $primaryKey = 'id';
    protected $fillable = [
        'idnew',
        'iduser',
        'pttt',
        'ngaydat',
        'tongdonhang',
        'gmail',
        'dienthoai',
        'ngayhethang'
    ];
}
