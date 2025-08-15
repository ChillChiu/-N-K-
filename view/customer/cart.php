<?php
$total = 0;
foreach ($items as $it) $total += $it['line_total'];
?>
<h1>Giỏ hàng</h1>
<form method="post" action="index.php?action=updatecart">
<table class="table">
<tr><th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Thành tiền</th></tr>
<?php foreach($items as $it): ?>
<tr>
    <td><?php echo htmlspecialchars($it['name']); ?></td>
    <td><?php echo number_format($it['price']); ?></td>
    <td><input type="number" name="qty[<?php echo $it['id']; ?>]" value="<?php echo $it['qty']; ?>" min="0"></td>
    <td><?php echo number_format($it['line_total']); ?></td>
</tr>
<?php endforeach; ?>
<tr><td colspan="3" style="text-align:right"><strong>Tổng:</strong></td><td><strong><?php echo number_format($total); ?> VND</strong></td></tr>
</table>
<p>
<button class="btn" type="submit">Cập nhật</button>
<?php if($total>0): ?>
<a class="btn" href="index.php?action=checkout">Thanh toán</a>
<?php endif; ?>
</p>
</form>
