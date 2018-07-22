<?php

namespace App\Core\Exceptions;

/**
 * PHPMailer exception handler
 * @package PHPMailer
 */
class PhpmailerException extends \Exception
{
    /**
     * Prettify error message output
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = '<strong>' . $this->getMessage() . "</strong><br />\n";
        return $errorMsg;
    }
}
