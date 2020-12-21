<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class ErrorMessage extends Code
{
    /**
     * @var string
     */
    public $message;

    public function onCreate(): void
    {
        $this->valid = false;

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        if ($this->getMethodData()->hasLocalVariable($this->message)) {
            $this->_code = '$_error_message = $' . $this->message . ';';
        } else {
            $this->_code = '$_error_message = \'' . $this->message . '\';';
        }
    }
}
