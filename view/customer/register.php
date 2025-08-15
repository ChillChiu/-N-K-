<h1>Đăng ký</h1>
<?php if(!empty($error)) echo '<p class="error">'.$error.'</p>'; ?>
<form method="post">
    <label>Tên đăng nhập</label>
    <input type="text" name="username" required>
    <label>Mật khẩu</label>
    <input type="password" name="password" required>
    <button class="btn">Tạo tài khoản</button>
</form>
