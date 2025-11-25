<?php $template='cart/show'; ?>
<h1>Your Cart</h1>
<?php $cart = $cart ?? []; if (!$cart): ?>
  <div class="alert alert-info">Cart is empty</div>
<?php else: ?>
  <table class="table">
    <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th></th></tr></thead>
    <tbody>
      <?php $grand=0; foreach ($cart as $pid=>$qty): $p=App\Models\Product::find((int)$pid); if(!$p) continue; $line=$p['price']*$qty; $grand+=$line; ?>
        <tr>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><?= (int)$qty ?></td>
          <td>?<?= number_format($p['price'],2) ?></td>
          <td>?<?= number_format($line,2) ?></td>
          <td>
            <form method="post" action="/cart/remove">
              <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
              <input type="hidden" name="product_id" value="<?= (int)$pid ?>">
              <button class="btn btn-sm btn-outline-danger">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-between align-items-center">
    <strong>Grand Total: ?<?= number_format($grand,2) ?></strong>
    <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
  </div>
<?php endif; ?>
