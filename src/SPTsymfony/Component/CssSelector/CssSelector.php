<?php

/*
 * This file is part of the SPTsymfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SPTsymfony\Component\CssSelector;

use SPTsymfony\Component\CssSelector\Parser\Shortcut\ClassParser;
use SPTsymfony\Component\CssSelector\Parser\Shortcut\ElementParser;
use SPTsymfony\Component\CssSelector\Parser\Shortcut\EmptyStringParser;
use SPTsymfony\Component\CssSelector\Parser\Shortcut\HashParser;
use SPTsymfony\Component\CssSelector\XPath\Extension\HtmlExtension;
use SPTsymfony\Component\CssSelector\XPath\Translator;

/**
 * CssSelector is the main entry point of the component and can convert CSS
 * selectors to XPath expressions.
 *
 * $xpath = CssSelector::toXpath('h1.foo');
 *
 * This component is a port of the Python cssselector library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @api
 */
class CssSelector
{
    private static $html = true;

    /**
     * Translates a CSS expression to its XPath equivalent.
     * Optionally, a prefix can be added to the resulting XPath
     * expression with the $prefix parameter.
     *
     * @param mixed   $cssExpr The CSS expression.
     * @param string  $prefix  An optional prefix for the XPath expression.
     *
     * @return string
     *
     * @api
     */
    public static function toXPath($cssExpr, $prefix = 'descendant-or-self::')
    {
        $translator = new Translator();

        if (self::$html) {
            $translator->registerExtension(new HtmlExtension($translator));
        }

        $translator
            ->registerParserShortcut(new EmptyStringParser())
            ->registerParserShortcut(new ElementParser())
            ->registerParserShortcut(new ClassParser())
            ->registerParserShortcut(new HashParser())
        ;

        return $translator->cssToXPath($cssExpr, $prefix);
    }

    /**
     * Enables the HTML extension.
     */
    public static function enableHtmlExtension()
    {
        self::$html = true;
    }

    /**
     * Disables the HTML extension.
     */
    public static function disableHtmlExtension()
    {
        self::$html = false;
    }
}
