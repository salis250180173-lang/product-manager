<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Generate CSRF Token untuk keamanan Delete
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// Fitur Search (GET)
$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :q OR category LIKE :q ORDER BY id DESC");
    $stmt->execute(['q' => "%$q%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manager</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>Product Manager</h1>
                <p style="color: #64748b; font-size: 0.9rem; margin-top: 4px;">Kelola inventaris produk dengan aman & praktis</p>
            </div>
            <a href="create.php" class="btn">+ Tambah Produk</a>
        </header>

        <!-- Form Cari (GET) -->
        <form method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="q" placeholder="Cari nama atau kategori..." value="<?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?>" style="padding: 10px; width: 300px; border-radius: 8px; border: 1px solid #cbd5e1;">
            <button type="submit" class="btn">Cari</button>
            <?php if ($q !== ''): ?>
                <a href="index.php" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </form>

        <?php if (isset($_GET['status'])): ?>
            <div class="alert-success">
                <?php
                    if ($_GET['status'] === 'created') echo "Produk berhasil ditambahkan!";
                    elseif ($_GET['status'] === 'updated') echo "Produk berhasil diperbarui!";
                    elseif ($_GET['status'] === 'deleted') echo "Produk berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>

        <div class="products">
            <?php if (empty($products)): ?>
                <p style="color: #64748b;">Belum ada produk yang tersedia.</p>
            <?php else: ?>
                <?php foreach ($products as $p): ?>
                    <div class="card">
                        <div>
                            <span class="badge"><?= htmlspecialchars($p['category'], ENT_QUOTES, 'UTF-8') ?></span>
                            <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><strong>Harga:</strong> Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                            <p><strong>Stok:</strong> <?= (int)$p['stock'] ?> unit</p>
                        </div>
                        <div class="actions">
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning" style="flex:1; text-align:center;">Edit</a>
                            
                            <!-- Form Delete dengan POST & CSRF Token -->
                            <form method="POST" action="delete.php" style="flex:1;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                                <button type="submit" class="btn btn-danger" style="width:100%;">Hapus</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>