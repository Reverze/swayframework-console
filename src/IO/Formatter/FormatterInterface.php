<?php

namespace Sway\Component\Console\IO\Formatter;

interface FormatterInterface
{
    /**
     * Formats given value
     * @param mixed $context
     */
    public function format($context); 
}


?>