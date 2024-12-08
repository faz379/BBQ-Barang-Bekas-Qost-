<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Data Barang Marketplace</title>
    <style>
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
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
                                            <td>Rp. <?= number_format($barang['harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <span class="badge <?= $barang['status'] == 'Tersedia' ? 'badge-success' : 'badge-warning' ?>">
                                                    <?= htmlspecialchars($barang['status']) ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($barang['kontak']) ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= base_url('barang/show/' . $barang['barang_id']) ?>" 
                                                       class="btn btn-sm btn-warning">
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
                            <?= $pager->links('barang', 'bootstrap_pagination') ?>
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
    
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>
</html>