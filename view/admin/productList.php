<h1>Quản lý sản phẩm</h1>
<p><a class="btn" href="admin.php?action=product_add">+ Thêm sản phẩm</a></p>
<table class="table">
<tr><th>ID</th><th>Tên</th><th>Giá</th><th>Ảnh</th><th></th></tr>
<?php foreach($products as $p): ?>
<tr>
  <td><?php echo $p['id']; ?></td>
  <td><?php echo htmlspecialchars($p['name']); ?></td>
  <td><?php echo number_format($p['price']); ?></td>
  <td><?php echo htmlspecialchars($p['image']); ?></td>
  <td>
    <a href="admin.php?action=product_edit&id=<?php echo $p['id']; ?>">Sửa</a> |
    <a onclick="return confirm('Xóa?')" href="admin.php?action=product_delete&id=<?php echo $p['id']; ?>">Xóa</a>
  </td>
</tr>
<?php endforeach; ?>
</table>
