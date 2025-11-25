<?php $template='checkout/razorpay'; $config = require dirname(__DIR__,3).'/config/config.php'; ?>
<h1>Pay with Razorpay</h1>
<p>Order No: <strong><?= htmlspecialchars($order['order_no']) ?></strong></p>
<p>Total: <strong>?<?= number_format($order['total'],2) ?></strong></p>
<button id="rzp-button1" class="btn btn-primary">Pay Now</button>
<form id="verify" method="post" action="/checkout/razorpay/verify" class="mt-3" style="display:none">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <input type="hidden" name="order_no" value="<?= htmlspecialchars($order['order_no']) ?>">
</form>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  const options = {
    key: "<?= htmlspecialchars($config['razorpay']['key_id']) ?>",
    amount: <?= (int)($order['total']*100) ?>,
    currency: "INR",
    name: "Cordygen",
    description: "Order <?= htmlspecialchars($order['order_no']) ?>",
    handler: function (response){ document.getElementById('verify').submit(); },
    prefill: {},
    theme: { color: "#3399cc" }
  };
  const rzp1 = new Razorpay(options);
  document.getElementById('rzp-button1').onclick = function(e){ rzp1.open(); e.preventDefault(); }
</script>
