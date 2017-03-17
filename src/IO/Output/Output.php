<?php

namespace Sway\Component\Console\IO\Output;

use Sway\Component\Console\IO\Formatter\FormatterInterface;
use Sway\Component\Console\IO\Formatter\OutputFormatter;

abstract class Output implements OutputInterface
{
    /**
     * Output formatter
     * @var \Sway\Component\Console\IO\Formatter\FormatterInterface 
     */
    protected $formatter = null;
    
    public function __construct(FormatterInterface $formatter = null)
    {
        $this->formatter = $formatter ?: new OutputFormatter();
    }
    
    /**
     * {@inheritdoc}
     */
    public function write(string $context, bool $newline = false, array $parameters = array(), $formatter = null) 
    {
        /**
         * At first we will use default formatter
         */
        $outputFormatter = $this->formatter;
        
        if ($formatter instanceof FormatterInterface){
            $outputFormatter = $formatter;
        }
        
        /**
         * Formats message by output formatter
         */
        $message = $outputFormatter->format($context);
        
        $this->afterWrite($message, $newline);
    }
    
    /**
     * {@inheritdoc}
     */
    public function writeln(string $context, array $parameters = array(), $formatter = null) 
    {
        $this->write($context, true, $parameters, $formatter);
    }
    
    /**
     * {@inheritdoc}
     */
    public function writeArray(array $context, bool $separateByNewLine = false, array $params = array(), $formatter = null) 
    {
        foreach ($context as $message){
            if (is_string($message)){
                $this->write($message, $separateByNewLine, $params, $formatter);
            }
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFormatter(FormatterInterface $formatter) 
    {
        $this->formatter = $formatter;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFormatter() : FormatterInterface
    {
        return $this->formatter;
    }
    
    /**
     * Writes an message to the output.
     * @param string $message Message to the output
     * @param bool $addNewLine Whether to add a newline or not 
     */
    abstract protected function afterWrite(string $message, bool $addNewLine);
    
}


?>

