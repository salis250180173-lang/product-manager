<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$errors = [];
$name = $category = '';
$price = $stock = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'Umum');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    // Validasi aturan bisnis
    if (mb_strlen($name) < 3) {
        $errors['name'] = "Nama produk minimal 3 karakter.";
    }
    if ($price === false || $price <= 0) {
        $errors['price'] = "Harga harus berupa angka lebih dari 0.";
    }
    if ($stock === false || $stock < 0) {
        $errors['stock'] = "Stok tidak boleh negatif.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)");
            $stmt->execute([
                'name' => $name,
                'category' => $category,
                'price' => $price,
                'stock' => $stock
            ]);
            
            // Pola PRG (Post-Redirect-Get)
            header("Location: index.php?status=created");
            exit;
        } catch (PDOException $e) {
            $errors['general'] = "Gagal menyimpan: Nama produk sudah ada.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>Tambah Produk Baru</h2>
            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 20px;">Isi formulir berikut untuk menambahkan produk ke katalog.</p>

            <?php if (!empty($errors['general'])): ?>
                <p class="error-msg" style="margin-bottom: 12px;"><?= $errors['general'] ?></p>
            <?php endif; ?>

            <form method="POST" action="create.php">
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['name'])): ?><span class="error-msg"><?= $errors['name'] ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" step="0.01" name="price" value="<?= htmlspecialchars($price, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['price'])): ?><span class="error-msg"><?= $errors['price'] ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($stock, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['stock'])): ?><span class="error-msg"><?= $errors['stock'] ?></span><?php endif; ?>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn" style="flex:1;">Simpan Produk</button>
                    <a href="index.php" class="btn btn-secondary" style="flex:1; text-align:center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html><?php
session_start();
require_once __DIR__ . '/../config/db.php';

$errors = [];
$name = $category = '';
$price = $stock = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'Umum');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    // Validasi aturan bisnis
    if (mb_strlen($name) < 3) {
        $errors['name'] = "Nama produk minimal 3 karakter.";
    }
    if ($price === false || $price <= 0) {
        $errors['price'] = "Harga harus berupa angka lebih dari 0.";
    }
    if ($stock === false || $stock < 0) {
        $errors['stock'] = "Stok tidak boleh negatif.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)");
            $stmt->execute([
                'name' => $name,
                'category' => $category,
                'price' => $price,
                'stock' => $stock
            ]);
            
            // Pola PRG (Post-Redirect-Get)
            header("Location: index.php?status=created");
            exit;
        } catch (PDOException $e) {
            $errors['general'] = "Gagal menyimpan: Nama produk sudah ada.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>Tambah Produk Baru</h2>
            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 20px;">Isi formulir berikut untuk menambahkan produk ke katalog.</p>

            <?php if (!empty($errors['general'])): ?>
                <p class="error-msg" style="margin-bottom: 12px;"><?= $errors['general'] ?></p>
            <?php endif; ?>

            <form method="POST" action="create.php">
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['name'])): ?><span class="error-msg"><?= $errors['name'] ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" step="0.01" name="price" value="<?= htmlspecialchars($price, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['price'])): ?><span class="error-msg"><?= $errors['price'] ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($stock, ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (isset($errors['stock'])): ?><span class="error-msg"><?= $errors['stock'] ?></span><?php endif; ?>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn" style="flex:1;">Simpan Produk</button>
                    <a href="index.php" class="btn btn-secondary" style="flex:1; text-align:center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>