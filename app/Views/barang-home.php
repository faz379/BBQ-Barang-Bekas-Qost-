<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1rem;
            margin: 1rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-title {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .product-price {
            color: #28a745; /* Warna hijau untuk harga */
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }
        .product-description {
            font-size: 0.9rem;
            color: #666;
        }
        .btn {
            background-color: #007bff; /* Ganti warna tombol menjadi biru */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
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
<div class="container">
    <h1>Barang dari Qost</h1>
    <div class="grid">
        <!-- Example Product Card -->
        <?php foreach ($barangs as $barang): ?>
        <div class="product-card">
            <img src="<?= base_url('uploads/' . $barang['image_path']) ?>" alt="<?= $barang['nama_barang'] ?>" class="product-image">
            <h2 class="product-title"><?= $barang['nama_barang'] ?></h2>
            <p class="product-price">Rp <?= number_format($barang['harga'], 0, ',', '.') ?></p>
            <p class="product-description"><?= $barang['deskripsi'] ?></p>
            <a href="<?= site_url('barang/showHome/' . $barang['barang_id']) ?>" class="btn">View Details</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div style="text-align: center; padding: 1rem; background-color: rgba(0, 123, 255, 0.8); color: white;">
        <p>&copy; <?= date('Y') ?> E-Commerce. All rights reserved.</p>
    </div>
</footer>

</body>
</html>