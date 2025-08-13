<?php

namespace Core\Support;

class Path
{
    /**
     * Generate a public asset URL that works with or without /public in the URL.
     */
    public static function asset(string $path): string
    {
        $path = self::sanitizePath($path);

        $publicDir = self::getPublicDirName();

        $rootFs    = rtrim(ROOT_PATH, DIRECTORY_SEPARATOR);
        $publicFs  = $rootFs . DIRECTORY_SEPARATOR . $publicDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
        $directFs  = $rootFs . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);

        $baseUrl   = rtrim(self::path(), '/');

        // Determine URL variants
        $urlDirect = $baseUrl . '/' . $path;                          // e.g., http://host/app/css/style.css
        $urlPublic = $baseUrl . '/' . $publicDir . '/' . $path;       // e.g., http://host/app/public/css/style.css

        // If base already contains /public in URL
        $baseHasPublic = str_contains($baseUrl, '/' . $publicDir);

        // Priority: existing public asset
        if (file_exists($publicFs)) {
            return $baseHasPublic ? $urlDirect : $urlPublic;
        }

        // Fallback: asset in root
        if (file_exists($directFs)) {
            return $urlDirect;
        }

        // Guess: if base already has public, direct URL is correct
        if ($baseHasPublic) {
            return $urlDirect;
        }

        // Guess: if public directory exists, point there
        if (is_dir($rootFs . DIRECTORY_SEPARATOR . $publicDir)) {
            return $urlPublic;
        }

        // Default fallback
        return $urlDirect;
    }

    /**
     * Build a full URL from a relative path.
     */
    public static function url(?string $path): string
    {
        $base = rtrim(self::path(), '/');

        if ($path === null || preg_match('/^\/+$/', $path)) {
            return $base . '/';
        }

        return $base . '/' . self::sanitizePath($path);
    }

    /**
     * Return the base path of the application (filesystem).
     */
    public static function basePath(): string
    {
        return defined('ROOT_PATH') ? ROOT_PATH : dirname(__DIR__, 1);
    }

    /**
     * Return the public directory path (filesystem).
     */
    public static function publicPath(?string $path = null): string
    {
        $publicDir = self::getPublicDirName();
        $base      = self::basePath() . DIRECTORY_SEPARATOR . $publicDir;
        return $path === null ? $base : $base . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * Return the base application URL.
     */
    public static function path(): string
    {
        if (php_sapi_name() === 'cli' || !isset($_SERVER['SERVER_NAME'])) {
            return ROOT_PATH;
        }

        $protocol   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host       = filter_var($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'], FILTER_SANITIZE_URL);
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptDir  = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');

        return rtrim($protocol . $host . $scriptDir, '/');
    }

    /**
     * Return the current full URL without query string.
     */
    public static function fullPath(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $host     = $_SERVER['HTTP_HOST'] ?? '';
        $uri      = $_SERVER['REQUEST_URI'] ?? '';
        return strtok("$protocol://$host$uri", '?');
    }

    /**
     * Include an HTML/PHP template from /views directory.
     */
    public static function includeHtml(string $path): void
    {
        $viewPath = ROOT_PATH . '/views/' . (str_ends_with($path, '.php') ? $path : "$path.php");

        if (file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            throw new \RuntimeException("Template not found: $path");
        }
    }

    /**
     * Sanitize a path for safe URL output.
     */
    protected static function sanitizePath(string $path): string
    {
        $path = preg_replace('/[^a-zA-Z0-9\-._\/]/', '', $path);
        return trim($path, '/');
    }

    /**
     * Determine public directory name from constant or config.
     */
    protected static function getPublicDirName(): string
    {
        if (defined('PUBLIC_DIR')) {
            return PUBLIC_DIR;
        }

        if (function_exists('config')) {
            $cfg = config('app.public_dir') ?? null;
            if (!empty($cfg)) {
                return $cfg;
            }
        }

        return 'public';
    }

}