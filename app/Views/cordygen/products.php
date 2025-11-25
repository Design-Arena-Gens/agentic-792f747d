<?php $template='cordygen/products'; ?>
<h1>Cordygen Products</h1>
<div class="row">
  <?php foreach (($products ?? []) as $p): ?>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5><a href="/cordygen/product/<?= htmlspecialchars($p['slug']) ?>" class="text-decoration-none"><?= htmlspecialchars($p['name']) ?></a></h5>
          <div class="text-muted">?<?= number_format($p['price'],2) ?></div>
          <form method="post" action="/cart/add" class="mt-2">
            <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
            <input type="hidden" name="product_id" value="<?= (int)$p['id'] ?>">
            <button class="btn btn-sm btn-primary">Add to Cart</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
