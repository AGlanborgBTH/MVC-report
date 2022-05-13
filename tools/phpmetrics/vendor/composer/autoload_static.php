<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfe6d3bb441b1cdd62f2d20656606440
{
    public static $files = array (
        '5f0e95b8df5acf4a92c896dc3ac4bb6e' => __DIR__ . '/..' . '/phpmetrics/phpmetrics/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpParser\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/php-parser/lib/PhpParser',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'Hal\\' => 
            array (
                0 => __DIR__ . '/..' . '/phpmetrics/phpmetrics/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfe6d3bb441b1cdd62f2d20656606440::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfe6d3bb441b1cdd62f2d20656606440::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitcfe6d3bb441b1cdd62f2d20656606440::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitcfe6d3bb441b1cdd62f2d20656606440::$classMap;

        }, null, ClassLoader::class);
    }
}
