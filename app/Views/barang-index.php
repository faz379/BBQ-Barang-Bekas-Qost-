<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        header {
            background-color: #007bff; /* Ganti warna header menjadi biru */
            padding: 1rem;
            color: white;
        }
        header .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        header li {
            margin: 0 1rem;
        }
        header a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- HEADER: MENU -->
<header>
    <div class="menu">
        <div class="logo">
            <a href="#">BarangBekasQost</a>
        </div>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="../barang">Products</a></li>
            <li><a href="../logout">Logout</a></li>
        </ul>
    </div>
</header>

<!-- CONTENT -->
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Barang</h3>
                    <a href="<?= base_url('barang/create') ?>" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Kontak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($barangs as $key => $barang): ?>
                                    <tr class="text-center">
                                        <td><?= $key + 1 ?></td>
                                        <td>
                                            <?php if(!empty($barang['image_path'])): ?>
                                                <img src="<?= base_url('uploads/' . $barang['image_path']) ?>" 
                                                     class="img-thumbnail" 
                                                     alt="Gambar Barang">
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Tidak ada gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($barang['nama_barang']) ?></td>
                                        <td><?= !empty($barang['nama_kategori']) ? htmlspecialchars($barang['nama_kategori']) : 'Tidak ada kategori' ?></td>
                                        <td>Rp. <?= number_format($barang['harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge <?= $barang['status'] == 'Tersedia' ? 'badge-success' : 'badge-warning' ?>">
                                                <?= htmlspecialchars($barang['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= !empty($barang['kontak']) ? htmlspecialchars($barang['kontak']) : 'Tidak ada kontak' ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('barang/show/' . $barang['barang_id']) ?>" 
                                                   class="btn btn-sm btn-warning" aria-label="Detail Barang">
                                                    Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        <?= isset($pager) ? $pager->links('barang', 'bootstrap_pagination') : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>