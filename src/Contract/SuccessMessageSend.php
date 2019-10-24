<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SuccessMessageSend extends Code
{
    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code = 'if ($_success_message) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->getView()->setSuccessMessage($this->s(\'translator\')->trans($_success_message));
        }';
    }
}
