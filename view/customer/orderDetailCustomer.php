<h1>Chi tiết đơn hàng #<?php echo $order['id']; ?></h1>
<p><strong>Khách:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
<p><strong>Trạng thái:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
<table class="table">
<tr><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Thành tiền</th></tr>
<?php $sum=0; foreach($order['items'] as $it): $line=$it['quantity']*$it['price']; $sum+=$line;?>
<tr>
    <td><?php echo htmlspecialchars($it['name']); ?></td>
    <td><?php echo $it['quantity']; ?></td>
    <td><?php echo number_format($it['price']); ?></td>
    <td><?php echo number_format($line); ?></td>
</tr>
<?php endforeach; ?>
<tr><td colspan="3" style="text-align:right"><strong>Tổng:</strong></td><td><strong><?php echo number_format($sum); ?> VND</strong></td></tr>
</table>
<p><a href="index.php">Về trang chủ</a></p>
