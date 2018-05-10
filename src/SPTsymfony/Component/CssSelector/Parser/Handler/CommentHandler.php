<?php

/*
 * This file is part of the SPTsymfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SPTsymfony\Component\CssSelector\Parser\Handler;

use SPTsymfony\Component\CssSelector\Parser\Reader;
use SPTsymfony\Component\CssSelector\Parser\TokenStream;

/**
 * CSS selector comment handler.
 *
 * This component is a port of the Python cssselector library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
class CommentHandler implements HandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Reader $reader, TokenStream $stream)
    {
        if ('/*' !== $reader->getSubstring(2)) {
            return false;
        }

        $offset = $reader->getOffset('*/');

        if (false === $offset) {
            $reader->moveToEnd();
        } else {
            $reader->moveForward($offset + 2);
        }

        return true;
    }
}
