<?php

namespace Sway\Component\Console\Compiler\Exception;


class CommandCompilerException extends \Exception
{
    /**
     * Throws an exception when command name duplication occurred
     * @param string $commandName
     * @return \Sway\Component\Console\Compiler\Exception\CommandCompilerException
     */
    public static function commandNameDuplication(string $commandName, string $className) : CommandCompilerException
    {
        return (new CommandCompilerException(sprintf("Cannot register command with name '%s' at '%s' because it is used by another command", $commandName, $className)));
    }
    
    /**
     * Throws an exception when command name is undefined
     * @param string $className
     * @return \Sway\Component\Console\Compiler\Exception\CommandCompilerException
     */
    public static function commandNameUndefined(string $className) : CommandCompilerException
    {
        return (new CommandCompilerException(sprintf("Command's name is not registered at class '%s'", $className)));
    }
}



?>
