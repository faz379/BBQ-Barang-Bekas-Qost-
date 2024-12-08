<?php 

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';

    protected $allowedFields = 
    [
        'image_path',
        'nama_barang',
        'deskripsi',
        'harga',
        'status',
        'kontak'
    ];
}