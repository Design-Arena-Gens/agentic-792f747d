<?php
namespace App\Core;

class Response {
    private int $status = 200;
    public function setStatus(int $status): self { $this->status = $status; http_response_code($status); return $this; }
    public function json($data): void { header('Content-Type: application/json'); echo json_encode($data); }
    public function redirect(string $to): void { header('Location: '.$to); exit; }
    public function send(string $html): void { echo $html; }
}
