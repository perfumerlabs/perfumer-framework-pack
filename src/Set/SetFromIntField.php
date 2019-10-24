<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class SetFromIntField extends Set
{
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
            $code .= sprintf('if (!is_string($%s) && !is_numeric($%s)) {', $this->name, $this->name);
            $code .= sprintf('$%s = null;', $this->name);
            $code .= '} else {';
            $code .= sprintf('$%s = (int) $%s;', $this->name, $this->name);
            $code .= '}';
        } else {
            $code = sprintf('$%s = (int) $this->f(\'%s\');', $this->name, $this->value);
        }

        $this->_code = $code;

        $id = '_int_field__' . $this->name . '__' . $this->value;;

        $this->setId($id);
    }
}
