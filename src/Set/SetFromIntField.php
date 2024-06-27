<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Set;

use Perfumerlabs\Perfumer\ArgumentParseTrait;
use Perfumerlabs\Perfumer\ContractAnnotation\Set;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
#[\Attribute(
    \Attribute::TARGET_METHOD |
    \Attribute::TARGET_CLASS |
    \Attribute::IS_REPEATABLE
)]
class SetFromIntField extends Set
{
    use ArgumentParseTrait;

    public function __construct(
        public $_values = null,
        public $force = false,
        ...$_args
    )
    {
        $_args = $this->parseArgument($this->_values, $_args, ['force']);
        parent::__construct(...$_args);
    }

    public function onCreate(): void
    {
        $this->tags = ['controller'];

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
