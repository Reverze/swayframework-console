<?php

namespace Sway\Component\Console\Input\Exception;

class FlagException extends \Exception
{
    /**
     * Throws an exception when term contains more than one character
     * @param string $invalidFlag
     * @return \Sway\Component\Console\Input\Exception\FlagException
     */
    public static function onlyOneChar(string $invalidFlag) : FlagException
    {
        return (new FlagException(sprintf("Flag is a single-character term! '%s' is invalid", $invalidFlag)));
    }
    
}


?>

