<?php

namespace Core\Http;

use Core\Foundation\Application;

class HttpKernel
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;


    }

    public function handle()
    {
        // Boot the app for HTTP context
        $this->app->init();
    }

    public function terminate(): void
    {
        // If you need terminate middleware/events
        // Right now just end session
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
    }
}
