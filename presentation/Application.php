<?php

declare(strict_types=1);

namespace Presentation;

use Illuminate\Foundation\Application as IlluminateApplication;

final class Application extends IlluminateApplication
{
    /**
     * Get the path to the application "app" directory.
     *
     * @param  string  $path
     * @return string
     */
    public function path($path = '')
    {
        $appPath = $this->appPath ?: $this->basePath.DIRECTORY_SEPARATOR.'presentation';

        return $appPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
