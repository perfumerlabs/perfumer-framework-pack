<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromAuthUser extends Set
{
    public function onBuild(): void
    {
        parent::onBuild();

        $code = '$' . $this->name . ' = $this->getUser();';

        $this->_code = $code;

        $id = '_user__' . $this->name;

        $this->setId($id);
    }
}
