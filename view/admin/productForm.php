<h1><?php echo ($mode==='add'?'Thêm':'Sửa'); ?> sản phẩm</h1>
<form method="post">
    <label>Tên</label>
    <input type="text" name="name" value="<?php echo $p['name'] ?? ''; ?>" required>
    <label>Giá</label>
    <input type="number" step="0.01" name="price" value="<?php echo $p['price'] ?? ''; ?>" required>
    <label>Ảnh (tên file trong assets/images)</label>
    <input type="text" name="image" value="<?php echo $p['image'] ?? ''; ?>">
    <label>Mô tả</label>
    <textarea name="description" rows="5"><?php echo $p['description'] ?? ''; ?></textarea>
    <button class="btn">Lưu</button>
</form>
