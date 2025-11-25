<?php $template='cordygen/product_detail'; ?>
<?php if (!$product): ?>
  <div class="alert alert-warning">Product not found</div>
<?php else: ?>
  <div class="row">
    <div class="col-md-8">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <div class="mb-3">?<?= number_format($product['price'],2) ?></div>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <form method="post" action="/cart/add" class="mt-2">
        <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
        <input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
        <button class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
<?php endif; ?>
