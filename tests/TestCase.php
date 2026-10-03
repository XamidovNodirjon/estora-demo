<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $basePath = dirname(__DIR__);
        $app = require $basePath . '/bootstrap/app.php';
        $app->useDatabasePath($basePath . DIRECTORY_SEPARATOR . 'database');
        $app->useStoragePath($basePath . DIRECTORY_SEPARATOR . 'storage');
        $app->useAppPath($basePath . DIRECTORY_SEPARATOR . 'app');

        $this->traitsUsedByTest = class_uses_recursive(static::class);

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * The parameters to use with the migrate:fresh command.
     */
    protected function migrateFreshUsing()
    {
        return [
            '--path' => str_replace('\\', '/', dirname(__DIR__) . '/database/migrations'),
            '--realpath' => true,
        ];
    }
}
