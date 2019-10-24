<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class ErrorMessageSend extends Code
{
    public function onCreate(): void
    {
        $this->_is_validatable = false;

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code = 'if ($_error_message' . ($this->getMethodData()->isValidating() ? ' && !$_valid' : '') . ') {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->getView()->setErrorMessage($this->s(\'translator\')->trans($_error_message));
        }';
    }
}
