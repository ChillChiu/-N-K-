<?php
$total = 0;
foreach ($items as $it) $total += $it['line_total'];
?>
<h1>Thanh toán</h1>
<p>Vui lòng xác nhận đơn hàng.</p>
<ul>
<?php foreach($items as $it): ?>
<li><?php echo htmlspecialchars($it['name']); ?> x <?php echo $it['qty']; ?> = <?php echo number_format($it['line_total']); ?> VND</li>
<?php endforeach; ?>
</ul>
<p><strong>Tổng thanh toán: <?php echo number_format($total); ?> VND</strong></p>
<p><a class="btn" href="index.php?action=placeorder">Đặt hàng</a></p>
