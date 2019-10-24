<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromParam extends Set
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

        $code = '$' . $this->name . ' = $this->getContainer()->getParam(\'' . $this->value . '\');';

        $this->_code = $code;

        $id = '_param__' . $this->name;

        $this->setId($id);
    }
}
