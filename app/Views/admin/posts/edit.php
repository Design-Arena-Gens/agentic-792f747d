<?php $template='admin/posts/edit'; ?>
<h1>Edit Post</h1>
<form method="post" action="/admin/posts/<?= (int)($post['id'] ?? 0) ?>" class="row g-3">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" required value="<?= htmlspecialchars($post['title'] ?? '') ?>"></div>
  <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" required value="<?= htmlspecialchars($post['slug'] ?? '') ?>"></div>
  <div class="col-md-6"><label class="form-label">Brand</label><select name="brand" class="form-select"><option value="shnikh" <?= ($post['brand']??'')==='shnikh'?'selected':'' ?>>Shnikh</option><option value="cordygen" <?= ($post['brand']??'')==='cordygen'?'selected':'' ?>>Cordygen</option></select></div>
  <div class="col-12"><label class="form-label">Content</label><textarea name="content" class="form-control" rows="8"><?= htmlspecialchars($post['content'] ?? '') ?></textarea></div>
  <div class="col-12"><button class="btn btn-primary">Save</button></div>
</form>
