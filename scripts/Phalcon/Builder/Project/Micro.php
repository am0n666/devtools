<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

/**
 * Micro
 *
 * Builder to create Micro application skeletons
 *
 * @package Phalcon\Builder\Project
 */
class Micro extends ProjectBuilder
{
    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = [
        'app',
        'app/config',
        'app/models',
        'app/views',
        'app/migrations',
        'public',
        'public/img',
        'public/css',
        'public/temp',
        'public/files',
        'public/js',
        '.phalcon'
    ];

    /**
     * Create .htaccess files by default of application
     *
     * @return $this
     */
    private function createHtaccessFiles()
    {
        if (file_exists($this->options->get('projectPath') . '.htaccess') == false) {
            $code = '<IfModule mod_rewrite.c>'.PHP_EOL.
                "\t".'RewriteEngine on'.PHP_EOL.
                "\t".'RewriteRule  ^$ public/    [L]'.PHP_EOL.
                "\t".'RewriteRule  (.*) public/$1 [L]'.PHP_EOL.
                '</IfModule>';
            file_put_contents($this->options->get('projectPath').'.htaccess', $code);
        }

        if (file_exists($this->options->get('projectPath') . 'public/.htaccess') == false) {
            file_put_contents(
                $this->options->get('projectPath').'public/.htaccess',
                file_get_contents($this->options->get('templatePath') . '/project/micro/htaccess')
            );
        }

        if (file_exists($this->options->get('projectPath').'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1>' .
                '<p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($this->options->get('projectPath').'index.html', $code);
        }

        return $this;
    }

    /**
     * Create view files by default
     *
     * @return $this
     */
    private function createIndexViewFiles()
    {
        $engine = $this->options->get('templateEngine') == 'volt' ? 'volt' : 'phtml';

        $getFile = $this->options->get('templatePath') . '/project/micro/views/index.' . $engine;
        $putFile = $this->options->get('projectPath').'app/views/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/micro/views/404.' . $engine;
        $putFile = $this->options->get('projectPath').'app/views/404.' . $engine;
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->contains('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/micro/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/app.php';
        $putFile = $this->options->get('projectPath') . 'app/app.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createBootstrapFile()
    {
        $getFile = $this->options->get('templatePath') . '/project/micro/index.php';
        $putFile = $this->options->get('projectPath') . 'public/index.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

	private function CreateDirectory($DirName) {
		if (mkdir($DirName, 0777)) {
			return true;
		} else {
			return false;
		}
	}

    /**
     * Create CSS and JS files by default of application
     *
     * @return $this
     */
    private function createCssJsFiles()
    {
        $getFile = $this->options->get('templatePath') . '/public/css/dashboard.css';
        $putFile = $this->options->get('projectPath') . 'public/css/dashboard.css';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/css/bootstrap.min.css';
        $putFile = $this->options->get('projectPath') . 'public/css/bootstrap.min.css';
        $this->generateFile($getFile, $putFile);

		$this->CreateDirectory($this->options->get('projectPath') . 'public/fonts');
        $getFile = $this->options->get('templatePath') . '/public/fonts/glyphicons-halflings-regular.eot';
        $putFile = $this->options->get('projectPath') . 'public/fonts/glyphicons-halflings-regular.eot';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/fonts/glyphicons-halflings-regular.svg';
        $putFile = $this->options->get('projectPath') . 'public/fonts/glyphicons-halflings-regular.svg';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/fonts/glyphicons-halflings-regular.ttf';
        $putFile = $this->options->get('projectPath') . 'public/fonts/glyphicons-halflings-regular.ttf';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/fonts/glyphicons-halflings-regular.woff';
        $putFile = $this->options->get('projectPath') . 'public/fonts/glyphicons-halflings-regular.woff';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/fonts/glyphicons-halflings-regular.woff2';
        $putFile = $this->options->get('projectPath') . 'public/fonts/glyphicons-halflings-regular.woff2';
        $this->generateFile($getFile, $putFile);		

        $getFile = $this->options->get('templatePath') . '/public/js/bootstrap.min.js';
        $putFile = $this->options->get('projectPath') . 'public/js/bootstrap.min.js';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/js/dashboard.js';
        $putFile = $this->options->get('projectPath') . 'public/js/dashboard.js';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/js/jquery-3.4.1.min.js';
        $putFile = $this->options->get('projectPath') . 'public/js/jquery.min.js';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/public/js/utils.js';
        $putFile = $this->options->get('projectPath') . 'public/js/utils.js';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Build project
     *
     * @return bool
     */
    public function build()
    {
        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createBootstrapFile()
            ->createCssJsFiles()
            ->createHtaccessFiles()
            ->createIndexViewFiles();

        return true;
    }
}
