<?php 

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';

    protected $allowedFields = 
    [   
        'user_id',
        'category_id',  // Pastikan field ini sesuai dengan field di database
        'kategori',
        'image_path',
        'nama_barang',
        'deskripsi',
        'harga',
        'status',
        'kontak'
    ];

    public function getBarangsWithCategories()
    {
        return $this->select('barang.*, categories.nama_kategori')
                    ->join('categories', 'categories.category_id = barang.category_id', 'left')
                    ->paginate(10, 'barang');
    }
}