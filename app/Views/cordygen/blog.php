<?php $template='cordygen/blog'; ?>
<h1>Blog</h1>
<div class="list-group">
  <?php foreach (($posts ?? []) as $post): ?>
    <a class="list-group-item list-group-item-action" href="/cordygen/blog/<?= htmlspecialchars($post['slug']) ?>">
      <strong><?= htmlspecialchars($post['title']) ?></strong>
    </a>
  <?php endforeach; ?>
</div>
