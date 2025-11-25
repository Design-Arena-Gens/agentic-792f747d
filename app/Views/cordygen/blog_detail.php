<?php $template='cordygen/blog_detail'; ?>
<?php if(!$post): ?>
  <div class="alert alert-warning">Post not found</div>
<?php else: ?>
  <h1><?= htmlspecialchars($post['title']) ?></h1>
  <article><?= nl2br(htmlspecialchars($post['content'])) ?></article>
<?php endif; ?>
