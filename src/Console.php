<?php

namespace Sway\Component\Console;

use Sway\Component\Console\Input\ArgvInput;
use Sway\Distribution\Mapping\ClassFounder;
use Sway\Distribution\Mapping\Map;
use Sway\Distribution\Storage\StorageDriver;
use Sway\Component\Console\Command;
use Sway\Component\Console\Routing\Router;
use Sway\Component\Console\Compiler\CommandCompiler;
use Sway\Component\Console\IO\Output\OutputInterface;

class Console
{
    /**
     * Command line input
     * @var \Sway\Component\Console\Input\ArgvInput
     */
    private $input = null;
    
    /**
     * Class founder service
     * @var \Sway\Distribution\Mapping\ClassFounder
     */
    private $classFounder = null;
    
    /**
     * Storage driver
     * @var \Sway\Distribution\Storage\StorageDriver
     */
    private $storageDriver = null;
    
    /**
     *
     * @var \Sway\Component\Console\Routing\Router
     */
    private $router = null;
    
    /**
     * Commands compiler
     * @var \Sway\Component\Console\Compiler\CommandCompiler
     */
    private $commandCompiler = null;
    
    /**
     * Default console output interface
     * @var \Sway\Component\Console\IO\Output\OutputInterface
     */
    private $output = null;
    
    public function __construct(ClassFounder $classFounder, StorageDriver $storageDriver, Router $router, CommandCompiler $compiler)
    {
        if (empty($this->classFounder)){
            $this->classFounder = $classFounder;
        }
        
        if (empty($this->storageDriver)){
            $this->storageDriver = $storageDriver;
        } 
        
        if (empty($this->router)){
            $this->router = $router;
        }
        
        if (empty($this->commandCompiler)){
            $this->commandCompiler = $compiler;
        }
        
        $this->openConsoleOutput();
        $this->initializeRouter();
        
    }
    
    /**
     * Creates a new instance of console
     * @param string $commandLine
     * @return \Sway\Component\Console\Console
     */
    public function createNew(string $commandLine = "") : Console
    {
        $console = new Console($this->classFounder, $this->storageDriver);
        
        /**
         * If custom argv has been defined
         */
        if (!empty($commandLine) and strlen($commandLine)){
            $argvInput = new ArgvInput(explode(" ", $commandLine));
            $console->setInput($argvInput);
        }
        
        return $console;
    }
    
    /**
     * Opens console output
     */
    private function openConsoleOutput()
    {
        $this->output = new IO\Output\ConsoleOutput();
    }
    
    /**
     * Gets console output interface
     * @return \Sway\Component\Console\IO\Output\OutputInterface
     */
    public function getOutput() : OutputInterface
    {
        return $this->output;   
    }
    
    /**
     * Initialzies router
     */
    private function initializeRouter()
    {
        $this->compileCommands();    
    }
    
    
    private function compileCommands()
    {   
       
        /**
         * If router doesnt have any defined routes, so we are going to find defined commands at project
         */
        if ($this->router->isEmpty()){
            /**
             * Searchs all classess defined in 'Command' namespace and ends with 'Command' word
             * at current project. 
             */
            $commandsClasses = $this->classFounder->searchBy([
                'subnamespace' => 'Task',
                'sufix' => 'Command'
            ]);
            
            /**
             * Transforms into map
             */
            $commandsClassessMap = new Map();
            $commandsClassessMap->addClassess($commandsClasses);
            
            $commands = $commandsClassessMap->findAllByAncestor(Command\Command::class);
            
            $this->router->addFromDefinitions($commands);
        }           
    }
    
    /**
     * Sets input
     * @param ArgvInput $input
     */
    public function setInput(ArgvInput $input)
    {
        $this->input = $input;
    }
    
    public function execute()
    {
        
        /**
         * Input allows invoke many commands so we get invokes commands as array
         */
        $commandRoutes = $this->input->getCommandRoutes();
        
        
        foreach ($commandRoutes as $commandRoute){
            /**
             * Route path is as command name
             */
            $routePath = $commandRoute->getRoutePath();
            
            if (!$this->router->has($routePath)){
                echo "[Warning!] This command is not specified\n";
            }
            
        }
    }
    
    public function onConsoleLaunch($eventArgs)
    {
        var_dump (">>>>> onConsoleLaunch event triggered");
    }
    
}


?>