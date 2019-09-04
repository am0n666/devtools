<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->configDir,
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->pluginsDir,
        $config->application->migrationsDir,
        $config->application->viewsDir,
        $config->application->libraryDir,
        $config->application->formsDir,
        $config->application->cacheDir
    ]
)->register();

if (is_file(BASE_PATH . '/vendor/autoload.php')) {
	require_once BASE_PATH . '/vendor/autoload.php';
}