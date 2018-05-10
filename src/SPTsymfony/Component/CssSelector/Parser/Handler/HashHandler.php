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
use SPTsymfony\Component\CssSelector\Parser\Token;
use SPTsymfony\Component\CssSelector\Parser\TokenStream;
use SPTsymfony\Component\CssSelector\Parser\Tokenizer\TokenizerEscaping;
use SPTsymfony\Component\CssSelector\Parser\Tokenizer\TokenizerPatterns;

/**
 * CSS selector comment handler.
 *
 * This component is a port of the Python cssselector library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
class HashHandler implements HandlerInterface
{
    /**
     * @var TokenizerPatterns
     */
    private $patterns;

    /**
     * @var TokenizerEscaping
     */
    private $escaping;

    /**
     * @param TokenizerPatterns $patterns
     * @param TokenizerEscaping $escaping
     */
    public function __construct(TokenizerPatterns $patterns, TokenizerEscaping $escaping)
    {
        $this->patterns = $patterns;
        $this->escaping = $escaping;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Reader $reader, TokenStream $stream)
    {
        $match = $reader->findPattern($this->patterns->getHashPattern());

        if (!$match) {
            return false;
        }

        $value = $this->escaping->escapeUnicode($match[1]);
        $stream->push(new Token(Token::TYPE_HASH, $value, $reader->getPosition()));
        $reader->moveForward(strlen($match[0]));

        return true;
    }
}
