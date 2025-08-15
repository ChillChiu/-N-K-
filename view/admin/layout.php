<?php
function adminHeader($title='Admin - Milk Tea') {
echo '<!doctype html><html><head><meta charset="utf-8"><title>'.$title.'</title><link rel="stylesheet" href="assets/css/style.css"></head><body>';
echo '<div class="nav"><a href="admin.php">Dashboard</a> | <a href="admin.php?action=products">Sản phẩm</a> | <a href="admin.php?action=orders">Đơn hàng</a> | <a href="index.php">Website</a> | ';
if (isset($_SESSION['user']) && $_SESSION['user']['role']==='admin') {
    echo 'Admin: '.$_SESSION['user']['username'].' | <a href="admin.php?action=logout">Đăng xuất</a>';
} else {
    echo '<a href="admin.php?action=login">Đăng nhập</a>';
}
echo '</div><div class="container">';
}
function adminFooter(){ echo '</div><footer class="footer">Milk Tea Admin</footer></body></html>'; }
function renderAdmin($view, $data) { extract($data); adminHeader(); include __DIR__ . "/$view.php"; adminFooter(); }
?>
