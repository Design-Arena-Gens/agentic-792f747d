<?php $template='admin/products/index'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Products</h1>
  <a href="/admin/products/create" class="btn btn-primary">New Product</a>
</div>
<table class="table">
  <thead><tr><th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th></th></tr></thead>
  <tbody>
  <?php foreach (($products ?? []) as $p): ?>
    <tr>
      <td><?= (int)$p['id'] ?></td>
      <td><?= htmlspecialchars($p['name']) ?></td>
      <td><?= htmlspecialchars($p['brand']) ?></td>
      <td>?<?= number_format($p['price'],2) ?></td>
      <td class="text-end">
        <a href="/admin/products/<?= (int)$p['id'] ?>/edit" class="btn btn-sm btn-outline-secondary">Edit</a>
        <form method="post" action="/admin/products/<?= (int)$p['id'] ?>/delete" class="d-inline">
          <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
          <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
