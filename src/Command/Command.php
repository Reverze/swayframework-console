<?php

namespace Sway\Component\Console\Command;


class Command implements CommandInterface
{
    /**
     * Command's route paht
     * @var string
     */
    private $routePath = null;
    
    /**
     * Command's description
     * @var string
     */
    private $description = null;
    
    public function __construct()
    {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        
        
    }
    
    public function before()
    {
        
        
    }
    
    /**
     * Sets command name
     * @param string $routePath
     * @throws \Sway\Component\Console\Command\Exception\CommandException
     */
    protected final function setName(string $routePath)
    {
        if (empty($this->routePath)){
            $this->routePath = $routePath;
        }
        
        if (!strlen($this->routePath)){
            throw Exception\CommandException::emptyCommandRoutePath();
        }
    }
    
    /**
     * Sets command description
     * @param string $description
     */
    protected final function setDescription(string $description)
    {
        $this->description = $description;
    }
    
    /**
     * Gets command's name
     * @return string
     */
    public final function getName() : string
    {
        return (string) $this->routePath;
    }
    
    /**
     * Gets command's description
     * @return string|null
     */
    public final function getDescription() : string
    {
        return (string) $this->description;
    }
    
}


?>
