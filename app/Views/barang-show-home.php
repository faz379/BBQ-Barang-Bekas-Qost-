<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Detail Barang - <?= htmlspecialchars($barang['nama_barang']) ?></title>
    <style>
        .product-image {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .badge-custom {
            font-size: 1em;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('barang') ?>">Daftar Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Gambar Barang</h4>
                    </div>
                    <div class="card-body p-0">
                        <?php if(!empty($barang['image_path'])): ?>
                            <img src="<?= base_url('uploads/' . $barang['image_path']) ?>" 
                                 class="product-image img-fluid" 
                                 alt="Gambar Barang">
                        <?php else: ?>
                            <div class="alert alert-secondary text-center m-3">
                                Tidak ada gambar tersedia
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Informasi Barang</h4>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">
                            <?= htmlspecialchars($barang['nama_barang']) ?>
                            <span class="badge 
                                <?= $barang['status'] == 'Tersedia' ? 'badge-success' : 'badge-warning' ?> 
                                badge-custom">
                                <?= htmlspecialchars($barang['status']) ?>
                            </span>
                        </h2>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Harga:</strong>
                                <h4 class="text-primary">
                                    Rp. <?= number_format($barang['harga'], 0, ',', '.') ?>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <strong>Kontak Penjual:</strong>
                                <p>
                                    <i class="fas fa-phone"></i> 
                                    <?= htmlspecialchars($barang['kontak']) ?>
                                </p>
                            </div>
                        </div>

                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Deskripsi Barang</h5>
                                <p class="card-text">
                                    <?= nl2br(htmlspecialchars($barang['deskripsi'])) ?>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script>
    $(document).ready(function() {
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const barangId = $(this).data('barang-id');
            $('#deleteForm').attr('action', '<?= base_url('barang/delete/') ?>' + barangId);
            $('#deleteModal').modal('show');
        });
    });
    </script>
</body>
</html>