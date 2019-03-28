<?php

namespace AppBundle\Twig;

class BreakNode extends \Twig_Node
{
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->write("break;\n")
        ;
    }
}

