<?php
use App\Core\View;

function view_include(string $name, array $data = []) { View::include($name, $data); }
function asset(string $path): string { return '/assets/'.ltrim($path,'/'); }
function url(string $path): string { return rtrim('/', '/').$path; }
function brand_theme(string $brand): array {
    return $brand === 'cordygen' ? [
        'name' => 'Cordygen',
        'primary' => '#f97316',
        'logo' => '/assets/cordygen-logo.svg'
    ] : [
        'name' => 'Shnikh Agrobiotech',
        'primary' => '#0ea5e9',
        'logo' => '/assets/shnikh-logo.svg'
    ];
}
