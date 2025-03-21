<?php declare(strict_types=1);
/**
 * Copyright © 2024 cclilshy
 * Email: jingnigg@gmail.com
 *
 * This software is licensed under the MIT License.
 * For full license details, please visit: https://opensource.org/licenses/MIT
 *
 * By using this software, you agree to the terms of the license.
 * Contributions, suggestions, and feedback are always welcome!
 */

namespace Laravel\Ripple\Built;

use Illuminate\Foundation\Application;
use Ripple\File\File;
use Ripple\File\Monitor;

use function base_path;
use function file_exists;

class Factory
{
    /**
     * @return \Illuminate\Foundation\Application
     */
    public static function createApplication(): Application
    {
        return Application::configure(basePath: RIP_PROJECT_PATH)
            ->withRouting(
                web: RIP_PROJECT_PATH . '/routes/web.php',
                commands: RIP_PROJECT_PATH . '/routes/console.php',
                health: '/up',
            )
            ->withMiddleware()
            ->withExceptions()
            ->create();
    }

    /**
     * @return array
     */
    public static function initializeServices(): array
    {
        return [
            //            'auth',
            //            'cache',
            'cache.store',
            'config',
            'cookie',
            'db',
            'db.factory',
            'db.transactions',
            'encrypter',
            'files',
            'hash',
            'log',
            'router',
            'routes',
            //            'session',
            'session.store',
            'translator',
            //            'url',
            'view',
        ];
    }

    /**
     * @return string[]
     */
    public static function defaultServicesToWarm(): array
    {
        return [
            'auth',
            'cache',
            'cache.store',
            'config',
            'cookie',
            'db',
            'db.factory',
            'db.transactions',
            'encrypter',
            'files',
            'hash',
            'log',
            'router',
            'routes',
            'session',
            'session.store',
            'translator',
            'url',
            'view',
        ];
    }

    /**
     * @return \Ripple\File\Monitor
     */
    public static function createMonitor(): Monitor
    {
        $monitor = File::getInstance()->monitor();
        $monitor->add(base_path('/app'));
        $monitor->add(base_path('/bootstrap'));
        $monitor->add(base_path('/config'));
        $monitor->add(base_path('/routes'));
        $monitor->add(base_path('/resources'));
        if (file_exists(base_path('/.env'))) {
            $monitor->add(base_path('/.env'));
        }
        return $monitor;
    }
}
