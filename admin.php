<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: index.html');
    exit;
}

$accounts = [
    ['service' => 'Netflix', 'stock' => 5],
    ['service' => 'Disney+', 'stock' => 3],
    ['service' => 'HBO Max', 'stock' => 4],
    ['service' => 'Amazon Prime', 'stock' => 2]
];

function addStock($service) {
    global $accounts;
    foreach ($accounts as &$account) {
        if ($account['service'] == $service) {
            $account['stock']++;
            break;
        }
    }
}

function reduceStock($service) {
    global $accounts;
    foreach ($accounts as &$account) {
        if ($account['service'] == $service && $account['stock'] > 0) {
            $account['stock']--;
            break;
        }
    }
}

function addAccount($service) {
    global $accounts;
    array_push($accounts, ['service' => $service, 'stock' => 0]);
}

function removeLastAccount() {
    global $accounts;
    array_pop($accounts);
}

function removeAccount($service) {
    global $accounts;
    foreach ($accounts as $key => $account) {
        if ($account['service'] == $service) {
            unset($accounts[$key]);
            $accounts = array_values($accounts);
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addStock'])) {
        addStock($_POST['service']);
    } elseif (isset($_POST['reduceStock'])) {
        reduceStock($_POST['service']);
    } elseif (isset($_POST['addAccount'])) {
        addAccount($_POST['newAccount']);
    } elseif (isset($_POST['removeLastAccount'])) {
        removeLastAccount();
    } elseif (isset($_POST['removeAccount'])) {
        removeAccount($_POST['service']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="logout.php" method="POST">
        <button class="logout-button" type="submit">Logout</button>
    </form>

    <div class="admin-container">
        <h2>Manajemen Akun</h2>
        
        <h3>Daftar Akun</h3>
        <table>
            <tr>
                <th>Servis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?php echo $account['service']; ?></td>
                <td><?php echo $account['stock']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="service" value="<?php echo $account['service']; ?>">
                        <button class="admin-button add-stock" type="submit" name="addStock">Tambah Stok</button>
                        <button class="admin-button reduce-stock" type="submit" name="reduceStock">Kurangi Stok</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h3>Tambah Akun Baru</h3>
        <form method="POST">
            <input type="text" name="newAccount" placeholder="Nama Layanan" required>
            <button class="admin-button add-account" type="submit" name="addAccount">Tambah Akun</button>
        </form>

        <h3>Hapus Akun Terakhir</h3>
        <form method="POST">
            <button class="admin-button remove-last-account" type="submit" name="removeLastAccount">Hapus Akun Terakhir</button>
        </form>

        <h3>Hapus Akun Tertentu</h3>
        <form method="POST">
            <input type="text" name="service" placeholder="Nama Layanan untuk Dihapus" required>
            <button class="admin-button remove-account" type="submit" name="removeAccount">Hapus Akun</button>
        </form>
    </div>
</body>
</html>