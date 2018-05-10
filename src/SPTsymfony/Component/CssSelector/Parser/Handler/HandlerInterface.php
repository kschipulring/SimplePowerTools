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
 * CSS selector handler interface.
 *
 * This component is a port of the Python cssselector library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
interface HandlerInterface
{
    /**
     * @param Reader      $reader
     * @param TokenStream $stream
     *
     * @return bool
     */
    public function handle(Reader $reader, TokenStream $stream);
}
