<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3141ef2971a1717fb058a290f153c939
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Spatie\\PdfToText\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Spatie\\PdfToText\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/pdf-to-text/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3141ef2971a1717fb058a290f153c939::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3141ef2971a1717fb058a290f153c939::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
