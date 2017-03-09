<?php

namespace Sway\Component\Console\Compiler;

use Sway\Distribution\Mapping\Map;
use Sway\Distribution\Mapping\Definition;

class CommandCompiler 
{
    /**
     * Container which contains compiled commands
     * @var \Sway\Component\Console\Compiler\CompiledContainer
     */
    private $compiled = null;
    
    
    public function __construct()
    {
        /**
         * If compiled command container is not defiend
         */
        if (empty($this->compiled)){
            $this->compiled = new CompiledContainer();
        }
        
    }
    
    /**
     * 
     * @param \Sway\Distribution\Mapping\Definition[] $commandsClass
     */
    public function compileUsingDefinitions(array $commandsClass)
    {
        foreach ($commandsClass as $commandClass){
            /**
             * Gets instance of command class
             */
            $commandInstance = $commandClass->getClassInstance();
            
            /**
             * Invokes configure method on current command
             */
            $commandInstance->configure();
            
            $commandName = $commandInstance->getName();
            
            if (empty($commandName) || !strlen($commandName)){
                throw Exception\CommandCompilerException::commandNameUndefined($commandClass->getClassName());
            }
            
            /**
             * Command name duplication is not allowed, so we throw an exception
             */
            if ($this->compiled->hasByName($commandName)){
                throw Exception\CommandCompilerException::commandNameDuplication($commandInstance->getName(), $commandClass->getClassName());
            }
            
            $this->compiled->add($commandInstance);
            
        }
    }
    
    /**
     * Gets container which contains compiled commands
     * @return \Sway\Component\Console\Compiler\CompiledContainer
     */
    public function getCompiledContainer() : CompiledContainer
    {
        return $this->compiled;
    }
    
}


?>