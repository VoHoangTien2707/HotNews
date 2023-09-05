<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'tbl_binhluan';
    public $primaryKey = 'id';
    protected $fillable = [
        'tieude',
        'noidung',
        'name',
        'idnew',
    ];

    // use HasFactory;
}
