<?php
function registerUser($conn, $username, $password, $role='customer') {
    if ($username === '' || $password === '') return ['ok'=>false, 'error'=>'Thiếu thông tin'];
    // check exists
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($res)) return ['ok'=>false, 'error'=>'Username đã tồn tại'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users(username,password,role) VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $role);
    $ok = mysqli_stmt_execute($stmt);
    return ['ok'=>$ok];
}

function loginUser($conn, $username, $password) {
    $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM users WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($res);
    if ($user && password_verify($password, $user['password'])) {
        unset($user['password']);
        return $user;
    }
    return null;
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}
?>
