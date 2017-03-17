<?php

namespace Sway\Component\Console\Routing;

use Sway\Distribution\Storage\StorageDriver;
use Sway\Distribution\Storage\Channel;
use Sway\Component\Console\Compiler\CommandCompiler;
use Sway\Component\Console\Command\Command;
use Sway\Component\Console\Compiler\CompiledContainer;

class Router
{
    /**
     * Storage driver
     * @var \Sway\Distribution\Storage\StorageDriver
     */
    private $storageDriver = null;
    
    /**
     * Command compiler
     * @var \Sway\Component\Console\Compiler\CommandCompiler
     */
    private $commandCompiler = null;
    
    /**
     * Storage channel
     * @var \Sway\Distribution\Storage\Channel
     */
    private $channel = null;
    
    /**
     * Routes container
     * @var \Sway\Component\Console\Routing\RouteContainer
     */
    private $container = null;
    
    public function __construct(StorageDriver $storageDriver, CommandCompiler $compiler)
    {
        if (empty($this->storageDriver)){
            $this->storageDriver = $storageDriver;
        }
        
        if (empty($this->commandCompiler)){
            $this->commandCompiler = $compiler;
        }
        
        
        $this->initializeStorageChannel();
    }
    
    /**
     * Initializes storage channel
     */
    private function initializeStorageChannel()
    {
        $this->channel = $this->storageDriver->getChannel('clirts-map/cache');
        
        if (empty($this->container)){
            $this->container = new RouteContainer();
        }
        
        /**
         * If command routes is cached
         */
        if ($this->channel->has('routes')){
            $this->container->wakeup($this->channel->get('routes'));
        }
    }
    
    /**
     * Saves route container into storage
     */
    private function saveChanges()
    {
        $this->channel->set('routes', []);
        $this->channel->set('routes', $this->container->toArray());
    }
    
    /**
     * Checks if routes is defined
     * @return bool
     */
    public final function isEmpty() : bool
    {
        return $this->container->isEmpty();  
    }
    
    /**
     * Adds from class mapping definitions
     * @param array $definitions
     */
    public function addFromDefinitions(array $definitions)
    {
        /**
         * Compile commands using class definitions
         */
        $this->commandCompiler->compileUsingDefinitions($definitions);
        
        $compiledCommands = $this->commandCompiler->getCompiledContainer();
        
        $this->mapRoutesFromCompiled($compiledCommands);       
    }
    
    /**
     * Maps command routes from compiled container
     * @param CompiledContainer $compiledContainer
     */
    public final function mapRoutesFromCompiled(CompiledContainer $compiledContainer)
    {
        foreach($compiledContainer->intoArray() as $commandName => $commandObject){
            $this->container->addRoute(strtolower($commandName), get_class($commandObject));
        }
        $this->saveChanges();
    }
    
    
    
    /**
     * Maps route to command
     * @param Command $command
     */
    public final function mapRouteFromCommand(Command $command)
    {
        $this->container->addRoute(strtolower($command->getName()), get_class($command));
        $this->saveChanges();
    }
    
    /**
     * Checks if route is defined
     * @param string $commandName
     * @return bool
     */
    public function has(string $commandName) : bool
    {
        return $this->container->hasRoute(strtolower($commandName));   
    }
    
}


?>

