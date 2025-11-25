<?php $template='checkout/show'; ?>
<h1>Checkout</h1>
<?php $items=$items??[]; $total=$total??0; if (!$items): ?>
  <div class="alert alert-info">No items to checkout.</div>
<?php else: ?>
  <div class="mb-3">
    <ul class="list-group mb-3">
      <?php foreach ($items as $row): ?>
        <li class="list-group-item d-flex justify-content-between">
          <div><?= htmlspecialchars($row['product']['name']) ?> ? <?= (int)$row['qty'] ?></div>
          <div>?<?= number_format($row['line_total'],2) ?></div>
        </li>
      <?php endforeach; ?>
      <li class="list-group-item d-flex justify-content-between">
        <strong>Total</strong><strong>?<?= number_format($total,2) ?></strong>
      </li>
    </ul>
  </div>
  <form method="post" action="/checkout/place" class="row g-3">
    <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
    <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
    <div class="col-12"><label class="form-label">Address</label><textarea name="address" class="form-control" required></textarea></div>
    <div class="col-12">
      <label class="form-label">Payment</label>
      <select name="payment" class="form-select">
        <option value="cod">Cash on Delivery</option>
        <option value="razorpay">Razorpay</option>
      </select>
    </div>
    <div class="col-12"><button class="btn btn-primary">Place Order</button></div>
  </form>
<?php endif; ?>
