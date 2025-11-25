<?php $template='admin/login'; ?>
<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h1 class="h4 mb-3">Admin Login</h1>
        <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" action="/admin/login">
          <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
          <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
          <button class="btn btn-primary w-100">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</div>
