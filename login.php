<?php
session_start();

$login = $_COOKIE['login'] ?? '';
$blad = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    if ($login == 'admin' && $haslo == '1234') {
        $_SESSION['login'] = $login;

        if (isset($_POST['zapamietaj'])) {
            setcookie('login', $login, time() + 7 * 24 * 60 * 60);
        }

        header('Location: panel.php');
        exit;
    } else {
        $blad = 'Błędny login lub hasło!';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>

<h2>Logowanie</h2>

<form method="post">
    Login: <input type="text" name="login" value="<?php echo htmlspecialchars($login); ?>" required><br><br>
    Hasło: <input type="password" name="haslo" required><br><br>
    <input type="checkbox" name="zapamietaj"> Zapamiętaj mnie<br><br>
    <input type="submit" value="Zaloguj">
</form>

<p><?php echo $blad; ?></p>

</body>
</html>
