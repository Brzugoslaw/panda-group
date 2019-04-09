<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="/assets/css/login.css">
<?php
session_start();
require_once "Connector.php";
?>

<div class="container main-container">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for='email'>Email</label><input class="form-control" id="email" name="email" type="email" placeholder="Email" required>
        <label for='password'>Password</label><input class="form-control" name="password" type="password" placeholder="Password" required>
        <input class="btn btn-primary" id="submit" type="submit" name="submit">
    </form>
    <a href="form.php">Create account</a>
</div>
<?php

if (isset($_POST["submit"])) {
    $query_db = new Connector;
    $email = $_POST["email"];
    $result = $query_db->db_query('SELECT id FROM users WHERE email="' . $email . '"');
    $id = mysqli_fetch_row($result);

    if (!$id) {
        echo "<div class='error-email'>User with this email doesn't exist</div>";
    } else {
        $password = $_POST["password"];
        $result = $query_db->db_query('SELECT password FROM users WHERE id=' . $id[0] . '');
        $result = mysqli_fetch_row($result);
        if ($password == $result[0]) {
            $_SESSION['id'] = $id[0];
            header("Location: newsfeed.php");
        } else {
            echo "<div class='error-password'>wrong password</div>";
        }
    }
}

?>