<?php
function placeOrder($conn, $userId, $cart) {
    // start transaction
    mysqli_begin_transaction($conn);
    try {
        // compute total
        $items = [];
        $total = 0;
        if (empty($cart)) throw new Exception("Cart empty");
        $ids = array_keys($cart);
        $in  = implode(',', array_fill(0, count($ids), '?'));
        $types = str_repeat('i', count($ids));
        $stmt = mysqli_prepare($conn, "SELECT id, price FROM products WHERE id IN ($in)");
        mysqli_stmt_bind_param($stmt, $types, ...$ids);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($res)) {
            $pid = $row['id'];
            $qty = intval($cart[$pid]);
            $price = floatval($row['price']);
            $line = $qty * $price;
            $total += $line;
            $items[] = ['product_id'=>$pid, 'quantity'=>$qty, 'price'=>$price];
        }
        // insert order
        $stmt = mysqli_prepare($conn, "INSERT INTO orders(user_id,total,status) VALUES (?,?,'pending')");
        mysqli_stmt_bind_param($stmt, "id", $userId, $total);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($conn);
        // insert items
        foreach ($items as $it) {
            $stmt = mysqli_prepare($conn, "INSERT INTO order_items(order_id, product_id, quantity, price) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "iiid", $orderId, $it['product_id'], $it['quantity'], $it['price']);
            mysqli_stmt_execute($stmt);
        }
        mysqli_commit($conn);
        return $orderId;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        return 0;
    }
}

function getOrdersByUser($conn, $userId) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE user_id=? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function getOrderWithItems($conn, $orderId) {
    $stmt = mysqli_prepare($conn, "SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id=u.id WHERE o.id=?");
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    $order = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!$order) return null;
    $stmt = mysqli_prepare($conn, "SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id=?");
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    $items = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    $order['items'] = $items;
    return $order;
}

function getAllOrders($conn) {
    $sql = "SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.id DESC";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function updateOrderStatus($conn, $orderId, $status) {
    $stmt = mysqli_prepare($conn, "UPDATE orders SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "si", $status, $orderId);
    return mysqli_stmt_execute($stmt);
}
?>
