<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SuccessMessage extends Code
{
    /**
     * @var string
     */
    public $message;

    public function onBuild(): void
    {
        parent::onBuild();

        if ($this->getMethodData()->hasLocalVariable($this->message)) {
            $this->_code = '$_success_message = $' . $this->message . ';';
        } else {
            $this->_code = '$_success_message = \'' . $this->message . '\';';
        }
    }
}
