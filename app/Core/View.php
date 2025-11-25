<?php
namespace App\Core;

class View {
    public static function render(string $template, array $data = []): void {
        $root = dirname(__DIR__, 2);
        $templatePath = $root.'/app/Views/'.trim($template,'/').'.php';
        if (!file_exists($templatePath)) { http_response_code(500); echo 'View not found'; return; }
        extract($data);
        include $root.'/app/Views/layouts/main.php';
    }

    public static function include(string $template, array $data = []): void {
        $root = dirname(__DIR__, 2);
        $path = $root.'/app/Views/'.trim($template,'/').'.php';
        if (file_exists($path)) { extract($data); include $path; }
    }
}
