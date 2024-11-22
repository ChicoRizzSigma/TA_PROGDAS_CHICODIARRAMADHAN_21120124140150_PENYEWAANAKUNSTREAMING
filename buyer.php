<?php
session_start();

if ($_SESSION['role'] != 'buyer') {
    header('Location: index.html');
    exit;
}

$accounts = [
    ['service' => 'Netflix', 'email' => 'netflix@example.com', 'password' => 'netflix123'],
    ['service' => 'Disney+', 'email' => 'disneyplus@example.com', 'password' => 'disney123'],
    ['service' => 'HBO Max', 'email' => 'hbomax@example.com', 'password' => 'hbomax123'],
    ['service' => 'Amazon Prime', 'email' => 'prime@example.com', 'password' => 'prime123']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer - Sewa Akun</title>
    <link rel="stylesheet" href="style.css">
    <form action="logout.php" method="POST">
    <button class="logout-button" type="submit">Logout</button>
    </form>
</head>
<body>
        <div class="buyer-container">
            <h2>Pilih Akun untuk Disewa</h2>

            <form method="GET" action="rent.php">
                <?php foreach ($accounts as $account): ?>
                    <div class="account-option">
                        <input type="radio" id="<?php echo $account['service']; ?>" name="account" value="<?php echo $account['service']; ?>" required>
                        <label for="<?php echo $account['service']; ?>"><?php echo $account['service']; ?></label>
                    </div>
                <?php endforeach; ?>
                <button class="rent-button">Sewa Akun</button>
            </form>
        </div>
</body>
</html>