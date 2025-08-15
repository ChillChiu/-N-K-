<?php
session_start();
require_once __DIR__ . "../connect/connect.php";

// Load models
require_once __DIR__ . "/model/productModel.php";
require_once __DIR__ . "/model/userModel.php";
require_once __DIR__ . "/model/cartModel.php";
require_once __DIR__ . "/model/orderModel.php";

// Load customer views
require_once __DIR__ . "/view/customer/layout.php";

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'detail':
        $id = intval($_GET['id'] ?? 0);
        $product = getProductById($conn, $id);
        render('productDetail', ['product'=>$product]);
        break;
    case 'addcart':
        $id = intval($_GET['id'] ?? 0);
        addToCart($id, 1);
        header("Location: index.php?action=cart");
        exit;
    case 'cart':
        $cart = getCart();
        $products = getCartProducts($conn, $cart);
        render('cart', ['items'=>$products]);
        break;
    case 'updatecart':
        foreach ($_POST['qty'] ?? [] as $pid => $qty) {
            updateCart(intval($pid), intval($qty));
        }
        header("Location: index.php?action=cart");
        exit;
    case 'checkout':
        if (!isLoggedIn()) { header("Location: index.php?action=login"); exit; }
        $cart = getCart();
        $items = getCartProducts($conn, $cart);
        render('checkout', ['items'=>$items]);
        break;
    case 'placeorder':
        if (!isLoggedIn()) { header("Location: index.php?action=login"); exit; }
        $cart = getCart();
        if (empty($cart)) { header("Location: index.php"); exit; }
        $orderId = placeOrder($conn, $_SESSION['user']['id'], $cart);
        clearCart();
        header("Location: index.php?action=orderdetail&id=".$orderId);
        exit;
    case 'orderdetail':
        if (!isLoggedIn()) { header("Location: index.php?action=login"); exit; }
        $id = intval($_GET['id'] ?? 0);
        $order = getOrderWithItems($conn, $id);
        if (!$order) { header("Location: index.php"); exit; }
        render('orderDetailCustomer', ['order'=>$order]);
        break;
    case 'orders':
        if (!isLoggedIn()) { header("Location: index.php?action=login"); exit; }
        $orders = getOrdersByUser($conn, $_SESSION['user']['id']);
        render('orderHistory', ['orders'=>$orders]);
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $u = trim($_POST['username'] ?? '');
            $p = trim($_POST['password'] ?? '');
            $ok = registerUser($conn, $u, $p, 'customer');
            if ($ok['ok']) { header("Location: index.php?action=login"); exit; }
            $error = $ok['error'] ?? "Đăng ký thất bại";
            render('register', ['error'=>$error]);
        } else {
            render('register', []);
        }
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $u = trim($_POST['username'] ?? '');
            $p = trim($_POST['password'] ?? '');
            $user = loginUser($conn, $u, $p);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php"); exit;
            } else {
                render('login', ['error'=>'Sai tài khoản hoặc mật khẩu']);
            }
        } else {
            render('login', []);
        }
        break;
    case 'logout':
        unset($_SESSION['user']);
        header("Location: index.php");
        exit;
    default:
        $products = getAllProducts($conn);
        render('productList', ['products'=>$products]);
        break;
}
?>
