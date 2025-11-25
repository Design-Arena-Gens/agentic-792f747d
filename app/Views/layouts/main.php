<?php $brand = $brand ?? ($brand ?? null); $brand = $brand ?: (($_SERVER['REQUEST_URI'] ?? '/') && preg_match('#^/(shnikh|cordygen)\b#', $_SERVER['REQUEST_URI'], $m) ? $m[1] : null); $theme = brand_theme($brand ?? 'shnikh'); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($theme['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root { --brand-primary: <?= $theme['primary'] ?>; }
    .brand-bg { background: var(--brand-primary); }
    .brand-text { color: var(--brand-primary); }
    .nav-link.active { color: var(--brand-primary) !important; font-weight: 600; }
  </style>
</head>
<body>
  <?php view_include('partials/header', ['brand'=>$brand,'theme'=>$theme]); ?>
  <main class="container py-4">
    <?php view_include($template ?? ''); ?>
  </main>
  <?php view_include('partials/footer', ['brand'=>$brand,'theme'=>$theme]); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('[data-brand-switch]')?.forEach(function(sel){
      sel.addEventListener('change', function(){ window.location.href='/' + this.value; });
    });
  </script>
</body>
</html>
