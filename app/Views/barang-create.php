<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Tambah Barang - Marketplace</title>
    <style>
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if(session()->has('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach(session('errors') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Barang Baru
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('/barang/store') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                            <div class="form-group">
                                <label for="image_path">
                                    <i class="fas fa-image mr-2"></i>Gambar Barang
                                </label>
                                <div class="custom-file">
                                    <input type="file" 
                                           class="custom-file-input" 
                                           id="image_path" 
                                           name="image_path" 
                                           accept="image/*" 
                                           required>
                                    <label class="custom-file-label" for="image_path">
                                        Pilih Gambar
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_barang">
                                    <i class="fas fa-tag mr-2"></i>Nama Barang
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama_barang" 
                                       name="nama_barang" 
                                       placeholder="Masukkan Nama Barang" 
                                       value="<?= old('nama_barang') ?>" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">
                                    <i class="fas fa-align-left mr-2"></i>Deskripsi
                                </label>
                                <textarea class="form-control" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4" 
                                          placeholder="Masukkan Deskripsi Barang" 
                                          required><?= old('deskripsi') ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="harga">
                                    <i class="fas fa-money-bill-wave mr-2"></i>Harga
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" 
                                           class="form-control" 
                                           id="harga" 
                                           name="harga" 
                                           placeholder="Masukkan Harga" 
                                           value="<?= old('harga') ?>" 
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">
                                    <i class="fas fa-info-circle mr-2"></i>Status Barang
                                </label>
                                <select class="form-control" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="Tersedia" <?= old('status') == 'Tersedia' ? 'selected' : '' ?>>
                                        Tersedia
                                    </option>
                                    <option value="Habis" <?= old('status') == 'Habis' ? 'selected' : '' ?>>
                                        Habis
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kontak">
                                    <i class="fas fa-phone mr-2"></i>Kontak
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="kontak" 
                                       name="kontak" 
                                       placeholder="Masukkan Nomor Telepon/WA" 
                                       value="<?= old('kontak') ?>" 
                                       required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save mr-2"></i>Simpan Barang
                                </button>
                                <a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-block mt-2">
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script>
        // Custom file input label
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>