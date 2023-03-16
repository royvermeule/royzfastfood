<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitde446bda9541c12f89dd0cc1c15d2b06
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHProx\\Models\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHProx\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitde446bda9541c12f89dd0cc1c15d2b06::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitde446bda9541c12f89dd0cc1c15d2b06::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitde446bda9541c12f89dd0cc1c15d2b06::$classMap;

        }, null, ClassLoader::class);
    }
}