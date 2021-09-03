<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6822d737f7324f515d5d54331a246d08
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Liuweiliang\\Liuweiliang\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Liuweiliang\\Liuweiliang\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/..' . '/liuweiliang/qiniuaudit/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6822d737f7324f515d5d54331a246d08::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6822d737f7324f515d5d54331a246d08::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6822d737f7324f515d5d54331a246d08::$classMap;

        }, null, ClassLoader::class);
    }
}
