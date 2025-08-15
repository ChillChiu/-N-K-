<h1>Admin Login</h1>
<?php if(!empty($error)) echo '<p class="error">'.$error.'</p>'; ?>
<form method="post">
    <label>Tên đăng nhập</label>
    <input type="text" name="username" required>
    <label>Mật khẩu</label>
    <input type="password" name="password" required>
    <button class="btn">Đăng nhập</button>
</form>
<p>Gợi ý: import SQL sẽ tạo sẵn admin (user: admin / pass: 123456)</p>
