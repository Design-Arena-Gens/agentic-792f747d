<?php $template='order/track'; ?>
<h1>Track Order</h1>
<form method="post" action="/order/track" class="row g-3 mb-4">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <div class="col-md-6"><label class="form-label">Order Number</label><input name="order_no" class="form-control" placeholder="e.g., ORD..." required></div>
  <div class="col-12"><button class="btn btn-primary">Track</button></div>
</form>
<?php if(isset($result)): ?>
  <?php if(!$result): ?>
    <div class="alert alert-warning">Order not found</div>
  <?php else: ?>
    <div class="card"><div class="card-body">
      <div><strong>Status:</strong> <?= htmlspecialchars($result['status']) ?></div>
      <div><strong>Total:</strong> ?<?= number_format($result['total'],2) ?></div>
      <h5 class="mt-3">Items</h5>
      <ul>
        <?php foreach ($result['items'] as $it): ?>
          <li><?= htmlspecialchars($it['name']) ?> ? <?= (int)$it['qty'] ?> - ?<?= number_format($it['price']*$it['qty'],2) ?></li>
        <?php endforeach; ?>
      </ul>
    </div></div>
  <?php endif; ?>
<?php endif; ?>
