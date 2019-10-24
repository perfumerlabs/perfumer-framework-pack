<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromField extends Set
{
    public function onCreate(): void
    {
        if (!$this->value) {
            $this->value = $this->name;
        }

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $code = '$' . $this->name . ' = $this->f(\'' . $this->value . '\');';

        $this->_code = $code;

        $id = '_field__' . $this->name . '__' . $this->value;;

        $this->setId($id);
    }
}
