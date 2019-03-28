<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    function getTokenParsers() {
        return array(
            new BreakToken(),
        );
    }

    public function getName()
    {
        return 'app_extension';
    }
}

