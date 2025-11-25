<?php $template='admin/orders/show'; ?>
<h1>Order <?= htmlspecialchars($order['order_no'] ?? '') ?></h1>
<?php if(!$order): ?>
  <div class="alert alert-warning">Not found</div>
<?php else: ?>
  <div class="mb-3"><strong>Name:</strong> <?= htmlspecialchars($order['name']) ?></div>
  <div class="mb-3"><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></div>
  <div class="mb-3"><strong>Total:</strong> ?<?= number_format($order['total'],2) ?></div>
  <h5>Items</h5>
  <ul>
    <?php foreach ($order['items'] as $it): ?>
      <li><?= htmlspecialchars($it['name']) ?> ? <?= (int)$it['qty'] ?> - ?<?= number_format($it['price']*$it['qty'],2) ?></li>
    <?php endforeach; ?>
  </ul>
  <form method="post" action="/admin/orders/<?= (int)$order['id'] ?>/status" class="mt-3">
    <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
    <div class="input-group" style="max-width:320px">
      <select name="status" class="form-select">
        <?php foreach(['pending','paid','shipped','delivered','cancelled'] as $s): ?>
          <option value="<?= $s ?>" <?= ($order['status']===$s?'selected':'') ?>><?= ucfirst($s) ?></option>
        <?php endforeach; ?>
      </select>
      <button class="btn btn-primary">Update</button>
    </div>
  </form>
<?php endif; ?>
