<h1>Quản lý đơn hàng</h1>
<table class="table">
<tr><th>ID</th><th>Khách</th><th>Tổng</th><th>Trạng thái</th><th>Ngày</th><th></th></tr>
<?php foreach($orders as $o): ?>
<tr>
  <td>#<?php echo $o['id']; ?></td>
  <td><?php echo htmlspecialchars($o['username']); ?></td>
  <td><?php echo number_format($o['total']); ?> VND</td>
  <td><?php echo htmlspecialchars($o['status']); ?></td>
  <td><?php echo htmlspecialchars($o['order_date']); ?></td>
  <td><a href="admin.php?action=order_detail&id=<?php echo $o['id']; ?>">Xem</a></td>
</tr>
<?php endforeach; ?>
</table>
