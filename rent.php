<?php
session_start();

if ($_SESSION['role'] != 'buyer') {
    header('Location: index.html');
    exit;
}

$accounts = [
    ['service' => 'Netflix'],
    ['service' => 'Disney+'],
    ['service' => 'HBO Max'],
    ['service' => 'Amazon Prime']
];

function generateRandomEmail() {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $email = '';
    for ($i = 0; $i < 10; $i++) {
        $email .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $email . '@gmail.com';
}

function generateRandomPassword() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < 12; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

$selectedService = isset($_GET['account']) ? $_GET['account'] : null;

$selectedAccount = null;
foreach ($accounts as $account) {
    if ($account['service'] === $selectedService) {
        $selectedAccount = $account;
        break;
    }
}

// Email acak nnti kluar
if ($selectedAccount) {
    $randomEmail = generateRandomEmail();
    $randomPassword = generateRandomPassword();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="logout.php" method="POST">
        <button class="logout-button" type="submit">Logout</button>
    </form>
    <div class="rent-container">
        <h2>Detail Akun yang Disewa</h2>

        <?php if ($selectedAccount): ?>
            <div class="account-details">
                <p><strong>Servis:</strong> <?php echo $selectedAccount['service']; ?></p>
                <p><strong>Email:</strong> <?php echo $randomEmail; ?></p>
                <p><strong>Password:</strong> <?php echo $randomPassword; ?></p>
            </div>
        <?php else: ?>
            <p>Akun yang Anda pilih tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>