<?php $template='admin/products/edit'; ?>
<h1>Edit Product</h1>
<form method="post" action="/admin/products/<?= (int)($product['id'] ?? 0) ?>" class="row g-3">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required value="<?= htmlspecialchars($product['name'] ?? '') ?>"></div>
  <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" required value="<?= htmlspecialchars($product['slug'] ?? '') ?>"></div>
  <div class="col-md-6"><label class="form-label">Brand</label><select name="brand" class="form-select"><option value="shnikh" <?= ($product['brand']??'')==='shnikh'?'selected':'' ?>>Shnikh</option><option value="cordygen" <?= ($product['brand']??'')==='cordygen'?'selected':'' ?>>Cordygen</option></select></div>
  <div class="col-md-6"><label class="form-label">Price</label><input type="number" step="0.01" name="price" class="form-control" required value="<?= htmlspecialchars($product['price'] ?? '') ?>"></div>
  <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea></div>
  <div class="col-12"><button class="btn btn-primary">Save</button></div>
</form>
