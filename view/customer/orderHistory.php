<h1>Đơn hàng của bạn</h1>
<table class="table">
<tr><th>ID</th><th>Tổng</th><th>Trạng thái</th><th>Ngày</th><th></th></tr>
<?php foreach($orders as $o): ?>
<tr>
    <td>#<?php echo $o['id']; ?></td>
    <td><?php echo number_format($o['total']); ?> VND</td>
    <td><?php echo htmlspecialchars($o['status']); ?></td>
    <td><?php echo htmlspecialchars($o['order_date']); ?></td>
    <td><a href="index.php?action=orderdetail&id=<?php echo $o['id']; ?>">Xem</a></td>
</tr>
<?php endforeach; ?>
</table>
