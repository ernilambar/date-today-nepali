<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9232562740994ae1a0ece1bae12ce80
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Nilambar\\NepaliDate\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Nilambar\\NepaliDate\\' => 
        array (
            0 => __DIR__ . '/..' . '/ernilambar/nepali-date/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9232562740994ae1a0ece1bae12ce80::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9232562740994ae1a0ece1bae12ce80::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc9232562740994ae1a0ece1bae12ce80::$classMap;

        }, null, ClassLoader::class);
    }
}
