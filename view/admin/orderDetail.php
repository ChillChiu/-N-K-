<h1>Đơn hàng #<?php echo $order['id']; ?></h1>
<p><strong>Khách:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
<form method="post" action="admin.php?action=order_update&id=<?php echo $order['id']; ?>">
    <label>Trạng thái</label>
    <select name="status">
        <?php foreach(['pending','approved','canceled'] as $st): ?>
            <option value="<?php echo $st; ?>" <?php if($order['status']===$st) echo 'selected'; ?>><?php echo $st; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn">Cập nhật</button>
</form>
<table class="table" style="margin-top:15px">
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
