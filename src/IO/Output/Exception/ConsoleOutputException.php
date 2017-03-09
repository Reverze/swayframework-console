<?php

namespace Sway\Component\Console\IO\Output\Exception;

class ConsoleOutputException extends \Exception
{
   
    public static function cannotFindStandardOutputStream() : ConsoleOutputException
    {
        return (new ConsoleOutputException("Cannnot find standard output stream"));
    }
    
}


?>