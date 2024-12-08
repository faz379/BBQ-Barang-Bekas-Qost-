<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;

class BarangController extends Controller 
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $pager = \Config\Services::pager();
        $data = [
            'barangs' => $this->barangModel->paginate(10, 'barang'),
            'pager' => $pager
        ];

        return view('barang-index', $data);
    }

    public function create()
    {
        return view('barang-create');
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
            'kontak' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image_path');

        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads', $newName); 

            $this->barangModel->save([
                'image_path' => $newName, 
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'status' => $this->request->getPost('status'),
                'kontak' => $this->request->getPost('kontak'),
            ]);

            return redirect()->to('/barang')->with('success', 'Barang berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gambar tidak valid');
    }

    public function edit($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('barang-edit', $data);
    }

    public function update($id)
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image_path' => 'is_image[image_path]|max_size[image_path,2048]',
            'nama_barang' => 'required|min_length[3]',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'kontak' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image_path');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads', $newName);

            $this->barangModel->update($id, [
                'image_path' => $newName, 
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'status' => $this->request-> getPost('status'),
                'kontak' => $this->request->getPost('kontak'),
            ]);
        } else {
            
            $this->barangModel->update($id, [
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'status' => $this->request->getPost('status'),
                'kontak' => $this->request->getPost('kontak'),
            ]);
        }

        return redirect()->to('/barang')->with('success', 'Barang berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('/barang')->with('success', 'Barang berhasil dihapus.');
    }
}