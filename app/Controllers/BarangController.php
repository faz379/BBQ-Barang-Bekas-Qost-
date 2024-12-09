<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\CategoryModel; // Pastikan untuk mengimpor model kategori

class BarangController extends Controller 
{
    protected $barangModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->categoryModel = new CategoryModel(); // Inisialisasi model kategori
    }

    public function index()
    {
        $user_id = auth()->id();
        
        $pager = \Config\Services::pager();
        $data = [
            'barangs' => $this->barangModel->where('user_id', $user_id)->getBarangsWithCategories(),
            'pager' => $pager
        ];

        return view('barang-index', $data);
    }

    public function home()
    {
        $data = [
            'barangs' => $this->barangModel->getBarangsWithCategories(),
            'categories' => $this->categoryModel->findAll()
        ];

        return view('barang-home', $data);
    }

    public function create()
    {
        $data = [
            'categories' => $this->categoryModel->findAll() // Ambil semua kategori
        ];
        return view('barang-create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'image_path' => 'uploaded[image_path]|is_image[image_path]|max_size[image_path,2048]',
            'nama_barang' => 'required|min_length[3]',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'kontak' => 'required',
            'category_id' => 'required|integer' // Validasi untuk category_id
        ]);
    
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $image = $this->request->getFile('image_path');
    
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads', $newName); 
    
            // Ambil user_id dari sesi
            $user_id = auth()->id();
    
            $this->barangModel->save([
                'image_path' => $newName, 
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'status' => $this->request->getPost('status'),
                'kontak' => $this->request->getPost('kontak'),
                'user_id' => $user_id,
                'category_id' => $this->request->getPost('category_id'), // Menyimpan category_id
            ]);
    
            return redirect()->to('/barang')->with('success', 'Barang berhasil ditambahkan.');
        }
    
        return redirect()->back()->with('error', 'Gambar tidak valid');
    }

    public function edit($id)
    {
        $data['barang'] = $this->barangModel->find($id);

        $data['categories'] = $this->categoryModel->findAll(); // Ambil semua kategori
        return view('barang-edit', $data);
    }

    public function update($id)
    {
        $barang = $this->barangModel->find($id);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image_path' => 'is_image[image_path]|max_size[image_path,2048]',
            'nama_barang' => 'required|min_length[3]',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'kontak' => 'required',
            'category_id' => 'required|integer' // Validasi untuk category_id
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }



        $image = $this->request->getFile('image_path');

        $dataUpdate = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'status' => $this->request->getPost('status'),
            'kontak' => $this->request->getPost('kontak'),
            'category_id' => $this->request->getPost('category_id'), // Menyimpan category _id
        ];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (!empty($barang['image_path']) && file_exists('uploads/' . $barang['image_path'])) {
                unlink('uploads/' . $barang['image_path']);
            }

            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            $dataUpdate['image_path'] = $newName;
        } else {
            $dataUpdate['image_path'] = $barang['image_path'];
        }

        $this->barangModel->update($id, $dataUpdate);

        return redirect()->to('/barang')->with('success', 'Barang berhasil diperbarui.');
    }

    public function show($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('barang-show', $data);
    }

    public function showHome($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('barang-show-home', $data);
    }

    public function delete($id)
    {
        $barang = $this->barangModel->find($id);

        if (!empty($barang['image_path']) && file_exists('uploads/' . $barang['image_path'])) {
            unlink('uploads/' . $barang['image_path']);  
        }

        $this->barangModel->delete($id);
        return redirect()->to('/barang')->with('success', 'Barang berhasil dihapus.');
    }
}