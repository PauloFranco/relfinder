<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit395c9112c0e70dd00dcc4d9d392e298a
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Phpml' => 
            array (
                0 => __DIR__ . '/..' . '/php-ai/php-ml/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit395c9112c0e70dd00dcc4d9d392e298a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
