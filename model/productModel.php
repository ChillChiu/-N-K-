<?php
function getAllProducts($conn) {
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProductById($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

function addProduct($conn, $name, $price, $image, $desc) {
    $stmt = mysqli_prepare($conn, "INSERT INTO products(name,price,image,description) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "sdss", $name, $price, $image, $desc);
    return mysqli_stmt_execute($stmt);
}

function updateProduct($conn, $id, $name, $price, $image, $desc) {
    $stmt = mysqli_prepare($conn, "UPDATE products SET name=?, price=?, image=?, description=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sdssi", $name, $price, $image, $desc, $id);
    return mysqli_stmt_execute($stmt);
}

function deleteProduct($conn, $id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
?>
