<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromAllFields extends Set
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    public function onBuild(): void
    {
        parent::onBuild();

        $code = '$' . $this->name . ' = $this->f();';

        $this->_code = $code;

        $id = '_all_fields__' . $this->name;

        $this->setId($id);
    }
}
