<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromDomain extends Set
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * @var array
     */
    public $tags = ['controller'];

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

        $code = '$' . $this->name . ' = $this->s(\'domain.' . $this->value . '\');';

        $this->_code = $code;

        $id = '_domain__' . $this->name . '__' . $this->value;

        $this->setId($id);
    }
}
