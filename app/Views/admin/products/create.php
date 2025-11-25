<?php $template='admin/products/create'; ?>
<h1>New Product</h1>
<form method="post" action="/admin/products" class="row g-3">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Brand</label><select name="brand" class="form-select"><option value="shnikh">Shnikh</option><option value="cordygen">Cordygen</option></select></div>
  <div class="col-md-6"><label class="form-label">Price</label><input type="number" step="0.01" name="price" class="form-control" required></div>
  <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="5"></textarea></div>
  <div class="col-12"><button class="btn btn-primary">Create</button></div>
</form>
