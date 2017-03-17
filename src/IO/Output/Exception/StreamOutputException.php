<?php

namespace Sway\Component\Console\IO\Output\Exception;


class StreamOutputException extends \Exception
{
    /**
     * Throws an exception when stream resource is not specified
     * @return \Sway\Component\Console\IO\Output\Exception\StreamOutputException
     */
    public static function streamResourceNotSpecified() : StreamOutputException
    {
        return (new StreamOutputException("Stream resource is needed!"));
    }
    
    /**
     * Throws an exception when write to output is not available
     * @return \Sway\Component\Console\IO\Output\Exception\StreamOutputException
     */
    public static function unableToWriteOutput() : StreamOutputException
    {
        return (new StreamOutputException("Unable to write output"));
    }
}


?>