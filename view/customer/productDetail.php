<?php if(!$product): ?>
<p>Không tìm thấy sản phẩm.</p>
<?php else: ?>
<h1><?php echo htmlspecialchars($product['name']); ?></h1>
<img src="assets/images/<?php echo htmlspecialchars($product['image'] ?: 'placeholder.png'); ?>" alt="" style="max-width:250px">
<p><strong>Giá:</strong> <?php echo number_format($product['price']); ?> VND</p>
<p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
<p><a class="btn" href="index.php?action=addcart&id=<?php echo $product['id']; ?>">Thêm vào giỏ</a></p>
<?php endif; ?>
