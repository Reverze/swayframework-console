<?php

namespace Sway\Component\Console\Compiler;

use Sway\Component\Console\Command\Command;

class CompiledContainer
{
    /**
     * 
     * @var \Sway\Component\Console\Command\Command[]
     */
    private $compiledCommands = array();
    
    public function __construct() 
    {
        if (empty($this->compiledCommands)){
            $this->compiledCommands = array();
        }
    }
    
    /**
     * Adds compiled command into container
     * @param \Sway\Component\Console\Command\Command $command
     */
    public function add(Command $command)
    {
        $this->compiledCommands[$command->getName()] = $command;
    }
    
    /**
     * Checks if compiled command is exists by name
     * @param string $commandName
     * @return bool
     */
    public function hasByName(string $commandName) : bool
    {
        return array_key_exists($commandName, $this->compiledCommands);
    }
    
    /**
     * Checks if compiled is exists by giving command
     * @param Command $command
     * @return bool
     */
    public function has(Command $command) : bool
    {
        return array_key_exists($command->getName(), $this->compiledCommands);
    }
    
    /**
     * Gets compiled command
     * @param string $name
     * @return \Sway\Component\Console\Command\Command
     */
    public function get(string $name)
    {
        if (array_key_exists($name, $this->compiledCommands)){
            return $this->compiledCommands[$name];
        }
        
        return null;
    }
    
    /**
     * Transform container into array
     * @return \Sway\Component\Console\Command\Command[]
     */
    public function intoArray()
    {
        return $this->compiledCommands;
    }
}


?>

