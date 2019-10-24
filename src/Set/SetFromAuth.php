<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromAuth extends Set
{
    public function onBuild(): void
    {
        parent::onBuild();

        $code = '$' . $this->name . ' = $this->getAuth();';

        $this->_code = $code;

        $id = '_auth';

        $this->setId($id);
    }
}
