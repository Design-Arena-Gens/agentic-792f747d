<?php $template='admin/posts/create'; ?>
<h1>New Post</h1>
<form method="post" action="/admin/posts" class="row g-3">
  <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
  <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" required></div>
  <div class="col-md-6"><label class="form-label">Brand</label><select name="brand" class="form-select"><option value="shnikh">Shnikh</option><option value="cordygen">Cordygen</option></select></div>
  <div class="col-12"><label class="form-label">Content</label><textarea name="content" class="form-control" rows="8"></textarea></div>
  <div class="col-12"><button class="btn btn-primary">Create</button></div>
</form>
