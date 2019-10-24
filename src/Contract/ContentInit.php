<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class ContentInit extends Code
{
    public function onCreate(): void
    {
        $this->_is_validatable = false;

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code = '$_content = [];';
    }
}
