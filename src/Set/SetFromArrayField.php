<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromArrayField extends Set
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
     * @var bool
     */
    public $force = false;

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

        if (!$this->force) {
            $code = sprintf('$%s = $this->f(\'%s\');', $this->name, $this->value);
            $code .= sprintf('if (!is_array($%s)) {', $this->name);
            $code .= sprintf('$%s = [];', $this->name);
            $code .= '}';
        } else {
            $code = sprintf('$%s = (array) $this->f(\'%s\');', $this->name, $this->value);
        }

        $this->_code = $code;

        $id = '_array_field__' . $this->name . '__' . $this->value;

        $this->setId($id);
    }
}
