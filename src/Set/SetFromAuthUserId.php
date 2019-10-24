<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromAuthUserId extends Set
{
    public function onBuild(): void
    {
        parent::onBuild();

        $code = '$' . $this->name . ' = $this->getUserId();';

        $this->_code = $code;

        $id = '_user_id__' . $this->name;

        $this->setId($id);
    }
}
