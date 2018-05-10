<?php

/*
 * This file is part of the SPTsymfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SPTsymfony\Component\CssSelector\Parser\Shortcut;

use SPTsymfony\Component\CssSelector\Node\ElementNode;
use SPTsymfony\Component\CssSelector\Node\SelectorNode;
use SPTsymfony\Component\CssSelector\Parser\ParserInterface;

/**
 * CSS selector element parser shortcut.
 *
 * This component is a port of the Python cssselector library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
class ElementParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse($source)
    {
        // Matches an optional namespace, required element or `*`
        // $source = 'testns|testel';
        // $matches = array (size=4)
        //     0 => string 'testns:testel' (length=13)
        //     1 => string 'testns:' (length=7)
        //     2 => string 'testns' (length=6)
        //     3 => string 'testel' (length=6)
        if (preg_match('/^(([a-z]+)\|)?([\w-]+|\*)$/i', trim($source), $matches)) {
            return array(new SelectorNode(new ElementNode($matches[2] ?: null, $matches[3])));
        }

        return array();
    }
}
