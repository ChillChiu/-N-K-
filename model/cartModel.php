<?php
function getCart() {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    return $_SESSION['cart'];
}

function addToCart($productId, $qty) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (!isset($_SESSION['cart'][$productId])) $_SESSION['cart'][$productId] = 0;
    $_SESSION['cart'][$productId] += max(1, intval($qty));
}

function updateCart($productId, $qty) {
    if (!isset($_SESSION['cart'])) return;
    if ($qty <= 0) { unset($_SESSION['cart'][$productId]); }
    else { $_SESSION['cart'][$productId] = intval($qty); }
}

function clearCart() { unset($_SESSION['cart']); }

function getCartProducts($conn, $cart) {
    if (empty($cart)) return [];
    $ids = array_keys($cart);
    $in  = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id IN ($in)");
    mysqli_stmt_bind_param($stmt, $types, ...$ids);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($p = mysqli_fetch_assoc($res)) {
        $p['qty'] = $cart[$p['id']];
        $p['line_total'] = $p['qty'] * $p['price'];
        $rows[] = $p;
    }
    return $rows;
}
?>
