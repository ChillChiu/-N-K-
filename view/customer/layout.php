<?php
function headerTpl($title='Milk Tea Shop') {
echo '<!doctype html><html><head><meta charset="utf-8"><title>'.$title.'</title><link rel="stylesheet" href="assets/css/style.css"></head><body>';
echo '<div class="nav"><a href="index.php">Trang chủ</a> | <a href="index.php?action=cart">Giỏ hàng</a> | ';
if (isset($_SESSION['user'])) {
    echo 'Xin chào, '.$_SESSION['user']['username'].' | <a href="index.php?action=orders">Đơn hàng</a> | <a href="index.php?action=logout">Đăng xuất</a>';
} else {
    echo '<a href="index.php?action=login">Đăng nhập</a> | <a href="index.php?action=register">Đăng ký</a>';
}
echo '</div><div class="container">';
}
function footerTpl(){ echo '</div><footer class="footer">Milk Tea MVC Demo</footer></body></html>'; }

function render($view, $data) { extract($data); headerTpl(); include __DIR__ . "/$view.php"; footerTpl(); }
?>
