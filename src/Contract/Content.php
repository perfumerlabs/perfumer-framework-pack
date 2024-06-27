<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ArgumentParseTrait;
use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
#[\Attribute(
    \Attribute::TARGET_METHOD |
    \Attribute::TARGET_CLASS |
    \Attribute::IS_REPEATABLE
)]
class Content extends Code
{
    use ArgumentParseTrait;

    public function __construct(
        public $_values = null,
        public $name = null,
        public $value = null,
        ...$_args
    )
    {
        $_args = $this->parseArgument($this->_values, $_args, ['name', 'value']);
        parent::__construct(...$_args);
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $value = $this->value ?: $this->name;

        if ($this->name) {
            $this->_code = sprintf('$_content[\'%s\'] = $%s;', $this->name, $value);
        } else {
            $this->_code = sprintf('$_content = $%s;', $value);
        }
    }
}
