<?php
session_start();

if (isset($_COOKIE['login']) && isset($_COOKIE['key'])) {
    if ($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $_COOKIE['key'];
    }
}

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['logout_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['logout_message'] . '</div>';
    unset($_SESSION['logout_message']); // Clear the logout message from the session
}

// Check if the URL parameter logout is set and display the alert
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    echo '<div class="alert alert-success">Logout berhasil.</div>';
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login & Loogut PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<meta http-equiv="refresh" content="5;url=login.php">
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card w-50">
        <div class="card-body">
            <?php
                if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error']; ?>
                    </div>
            <?php    
                }
            ?>
            <h1>Form Login</h1>
            <form action="process.php" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="form-label">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>