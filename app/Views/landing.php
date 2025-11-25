<?php $template='landing'; ?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="p-4 border rounded-3">
      <h1 class="mb-3">Welcome</h1>
      <p class="text-muted">Which division do you want?</p>
      <form method="post" action="/lead" class="row g-3">
        <input type="hidden" name="_token" value="<?= htmlspecialchars(App\Core\CSRF::token()) ?>">
        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Division</label>
          <select name="brand" class="form-select" required>
            <option value="shnikh">Shnikh Agrobiotech</option>
            <option value="cordygen">Cordygen</option>
          </select>
        </div>
        <div class="col-12">
          <button class="btn btn-primary">Continue</button>
        </div>
      </form>
    </div>
  </div>
</div>
