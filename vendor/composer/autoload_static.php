<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc474e76751990fb2271257fa1df7e9fc
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'A3Rev\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'A3Rev\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'A3Rev\\WCQV' => __DIR__ . '/../..' . '/classes/class-woocommerce-quick-view-ultimate.php',
        'A3Rev\\WCQV\\Custom_Template' => __DIR__ . '/../..' . '/classes/class-quick-view-template.php',
        'A3Rev\\WCQV\\Dynamic_Gallery' => __DIR__ . '/../..' . '/classes/dynamic-gallery/class-wc-default-gallery.php',
        'A3Rev\\WCQV\\Style' => __DIR__ . '/../..' . '/classes/class-woocommerce-quick-view-ultimate-style.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc474e76751990fb2271257fa1df7e9fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc474e76751990fb2271257fa1df7e9fc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc474e76751990fb2271257fa1df7e9fc::$classMap;

        }, null, ClassLoader::class);
    }
}
