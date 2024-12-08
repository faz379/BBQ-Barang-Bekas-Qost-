<?php 

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'category';

    protected $allowedFields = 
    [
        'nama_kategori',
    ];
}