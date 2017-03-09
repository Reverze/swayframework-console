<?php

namespace Sway\Component\Console\IO\Output;

use Sway\Component\Console\IO\Formatter\FormatterInterface;

interface OutputInterface
{
    /**
     * Writes an message to the output.
     * @param string $context The message as a single string
     * @param bool $newline Whether to add new line at end of message or not
     * @param array $params The parameters
     * @param \Sway\Component\Console\IO\Formatter\FormatterInterface $formatter The output formatter
     */
    public function write(string $context, bool $newline = false, array $params = array(), $formatter = null);
    
    /**
     * Writes an message to the output and adds a newline at end of message
     * @param string $context
     * @param array $params The parameters
     * @param \Sway\Component\Console\IO\Formatter\FormatterInterface $formatter The output formatter
     */
    public function writeln(string $context, array $params = array(), $formatter = null);
    
    /**
     * Writes an messages to the output
     * @param array $context
     * @param bool $separateByNewLine Writes each message into a new line
     * @param array $params
     * @param \Sway\Component\Console\IO\Formatter\FormatterInterface $formatter The output formatter
     */
    public function writeArray(array $context, bool $separateByNewLine = false, array $params = array(), $formatter = null);
    
    /**
     * Sets default output formatter
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter);
    
    /**
     * Gets default output formatter
     * @return \Sway\Component\Console\IO\Formatter\FormatterInterface
     */
    public function getFormatter() : FormatterInterface;
    
}


?>