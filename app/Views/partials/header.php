<?php $b = $brand ?? null; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <span class="fw-bold brand-text me-2">DualBrand</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($b==='shnikh'): ?>
          <li class="nav-item"><a class="nav-link" href="/shnikh">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/services">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/products">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/rnd">R&amp;D</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/blog">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="/shnikh/contact">Contact</a></li>
        <?php elseif ($b==='cordygen'): ?>
          <li class="nav-item"><a class="nav-link" href="/cordygen">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/products">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/science">Science</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/blog">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/faq">FAQ</a></li>
          <li class="nav-item"><a class="nav-link" href="/cordygen/contact">Contact</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <?php endif; ?>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <select class="form-select" data-brand-switch style="width:auto">
          <option value="shnikh" <?= $b==='shnikh'?'selected':'' ?>>Shnikh</option>
          <option value="cordygen" <?= $b==='cordygen'?'selected':'' ?>>Cordygen</option>
        </select>
        <a href="/cart" class="btn btn-outline-secondary">Cart</a>
        <a href="/admin" class="btn btn-outline-primary">Admin</a>
      </div>
    </div>
  </div>
</nav>
