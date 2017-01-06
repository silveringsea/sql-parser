<?php

/**
 * Defines the localization helper infrastructure of the library.
 */

namespace SqlParser;

use MoTranslator;

class Translator
{
    /**
     * The MoTranslator loader object.
     *
     * @var MoTranslator\Loader
     */
    private static $loader;

    /**
     * The MoTranslator translator object.
     *
     * @var MoTranslator\Translator
     */
    private static $translator;

    /**
     * Loads transator.
     */
    public static function load()
    {
        if (is_null(self::$loader)) {
            // Create loader object
            self::$loader = new MoTranslator\Loader();

            // Set locale
            self::$loader->setlocale(
                self::$loader->detectlocale()
            );

            // Set default text domain
            self::$loader->textdomain('sqlparser');

            // Set path where to look for a domain
            self::$loader->bindtextdomain('sqlparser', __DIR__ . '/../locale/');
        }

        if (is_null(self::$translator)) {
            // Get translator
            self::$translator = self::$loader->getTranslator();
        }
    }

    /**
     * Translates a string.
     *
     * @param string $msgid String to be translated
     *
     * @return string translated string (or original, if not found)
     */
    public static function gettext($msgid)
    {
        self::load();

        return self::$translator->gettext($msgid);
    }
}
