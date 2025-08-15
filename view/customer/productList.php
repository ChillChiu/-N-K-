<?php if(empty($products)): ?>
<p>Chưa có sản phẩm.</p>
<?php else: ?>
<h1>Menu Trà Sữa</h1>
<div class="grid">
<?php foreach($products as $p): ?>
<div class="card">
    <img src="assets/images/<?php echo htmlspecialchars($p['image'] ?: 'placeholder.png'); ?>" alt="">
    <h3><?php echo htmlspecialchars($p['name']); ?></h3>
    <p><?php echo number_format($p['price']); ?> VND</p>
    <div class="actions">
        <a href="index.php?action=detail&id=<?php echo $p['id']; ?>">Chi tiết</a>
        <a href="index.php?action=addcart&id=<?php echo $p['id']; ?>">Thêm giỏ</a>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
