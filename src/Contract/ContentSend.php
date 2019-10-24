<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class ContentSend extends Code
{
    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code = 'if ($_content) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->getView()->setContent($_content);
        }';
    }
}
