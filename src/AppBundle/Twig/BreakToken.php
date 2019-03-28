<?php

namespace AppBundle\Twig;

class BreakToken extends \Twig_TokenParser
{
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        // Trick to check if we are currently in a loop.
        $currentForLoop = 0;

        for ($i = 1; true; $i++) {
            try {
                // if we look before the beginning of the stream
                // the stream will throw a \Twig_Error_Syntax
                $token = $stream->look(-$i);
            } catch (\Twig_Error_Syntax $e) {
                break;
            }

            if ($token->test(\Twig_Token::NAME_TYPE, 'for')) {
                $currentForLoop++;
            } else if ($token->test(\Twig_Token::NAME_TYPE, 'endfor')) {
                $currentForLoop--;
            }
        }
        if ($currentForLoop < 1) {
            throw new \Twig_Error_Syntax(
                'Break tag is only allowed in \'for\' loops.',
                $stream->getCurrent()->getLine(),
                $stream->getSourceContext()->getName()
            );
        }

        return new BreakNode();
    }

    public function getTag()
    {
        return 'break';
    }
}

