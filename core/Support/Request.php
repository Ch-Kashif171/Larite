<?php

namespace Core\Support;

use Exception;

class Request
{
    private array $fields = [];

    public function __construct()
    {
        $this->fields = $this->collectRequestFields();
    }

    // ------------------ Public API ------------------ //

    public function input(string $key): mixed
    {
        return $this->fields[$key] ?? null;
    }

    public function get(string $key): mixed
    {
        $this->ensureMethod('GET');
        return $_GET[$key] ?? null;
    }

    public function post(string $key): mixed
    {
        $this->ensureMethod('POST');
        return $_POST[$key] ?? null;
    }

    public function all(): array
    {
        return $this->fields;
    }

    public function has(string $key): bool
    {
        return isset($this->fields[$key]);
    }

    public function only(...$keys): array
    {
        return array_intersect_key($this->fields, array_flip($keys));
    }

    public function except(...$keys): array
    {
        return array_diff_key($this->fields, array_flip($keys));
    }

    public function getFile(string $key): array|null
    {
        return $_FILES[$key] ?? null;
    }

    public function getFiles(): array
    {
        return $_FILES ?? [];
    }

    public function hasFile(string $key): bool
    {
        return isset($_FILES[$key]) && !empty($_FILES[$key]['name']);
    }

    public function validateFile(array $file, array $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'], int $maxSize = 2 * 1024 * 1024): bool|string
    {
        if (!isset($file['error']) || is_array($file['error'])) {
            return 'Invalid file parameters.';
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return 'File upload error.';
        }

        if ($file['size'] > $maxSize) {
            return 'File size exceeds limit.';
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        if (!in_array($mime, $allowedTypes)) {
            return 'Invalid file type.';
        }

        return true;
    }

    public function session(): Session
    {
        return new Session();
    }

    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->fields[$key];
        }

        throw new \Exception("Key '$key' does not exist in request.");
    }

    // ------------------ Internal Logic ------------------ //

    private function collectRequestFields(): array
    {
        $data = $this->parseInputByType();
        $files = $this->mapFileNames();
        return array_merge($data, $files);
    }

    private function parseInputByType(): array
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        if ($this->isJson($contentType)) {
            return $this->parseJsonPayload();
        }

        return match ($method) {
            'GET' => $this->sanitize($_GET),
            'POST' => $this->sanitize($_POST),
            'PUT', 'PATCH' => $this->parseRawUrlEncoded(),
            default => [],
        };
    }

    private function parseJsonPayload(): array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            throw new Exception("Invalid JSON payload: " . json_last_error_msg());
        }

        return $this->sanitize($data);
    }

    private function parseRawUrlEncoded(): array
    {
        $raw = file_get_contents('php://input');
        parse_str($raw, $data);
        return $this->sanitize($data);
    }

    private function mapFileNames(): array
    {
        $names = [];
        foreach ($_FILES as $key => $file) {
            $names[$key] = $file['name'];
        }
        return $names;
    }

    private function sanitize($data): mixed
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    private function ensureMethod(string $expected): void
    {
        $actual = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (strtoupper($actual) !== strtoupper($expected)) {
            throw new \ErrorException("Expected $expected request, but received $actual");
        }
    }

    private function isJson(string $contentType): bool
    {
        return stripos($contentType, 'application/json') !== false;
    }
}
