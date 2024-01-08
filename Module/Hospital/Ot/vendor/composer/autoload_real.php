<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit3ef6c39e6dd6b3ef66c5c0220b4174e5
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit3ef6c39e6dd6b3ef66c5c0220b4174e5', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit3ef6c39e6dd6b3ef66c5c0220b4174e5', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit3ef6c39e6dd6b3ef66c5c0220b4174e5::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
