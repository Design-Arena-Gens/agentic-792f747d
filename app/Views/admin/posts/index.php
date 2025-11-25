<?php $template='admin/posts/index'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Posts</h1>
  <a href="/admin/posts/create" class="btn btn-primary">New Post</a>
</div>
<table class="table">
  <thead><tr><th>ID</th><th>Title</th><th>Brand</th><th></th></tr></thead>
  <tbody>
  <?php foreach (($posts ?? []) as $p): ?>
    <tr>
      <td><?= (int)$p['id'] ?></td>
      <td><?= htmlspecialchars($p['title']) ?></td>
      <td><?= htmlspecialchars($p['brand']) ?></td>
      <td class="text-end">
        <a href="/admin/posts/<?= (int)$p['id'] ?>/edit" class="btn btn-sm btn-outline-secondary">Edit</a>
        <form method="post" action="/admin/posts/<?= (int)$p['id'] ?>/delete" class="d-inline">
          <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
          <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
