<?php $template='admin/orders/index'; ?>
<h1>Orders</h1>
<table class="table">
  <thead><tr><th>Order No</th><th>Name</th><th>Status</th><th>Total</th><th></th></tr></thead>
  <tbody>
  <?php foreach (($orders ?? []) as $o): ?>
    <tr>
      <td><?= htmlspecialchars($o['order_no']) ?></td>
      <td><?= htmlspecialchars($o['name']) ?></td>
      <td><?= htmlspecialchars($o['status']) ?></td>
      <td>?<?= number_format($o['total'],2) ?></td>
      <td class="text-end"><a href="/admin/orders/<?= (int)$o['id'] ?>" class="btn btn-sm btn-outline-secondary">View</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
