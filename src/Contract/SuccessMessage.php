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
class SuccessMessage extends Code
{
    use ArgumentParseTrait;

    public function __construct(
        public $_values = null,
        public $message = null,
        ...$_args
    )
    {
        $_args = $this->parseArgument($this->_values, $_args, ['message']);
        parent::__construct(...$_args);
    }

    public function onBuild(): void
    {
        parent::onBuild();

        if ($this->getMethodData()->hasLocalVariable($this->message)) {
            $this->_code = '$_success_message = $' . $this->message . ';';
        } else {
            $this->_code = '$_success_message = \'' . $this->message . '\';';
        }
    }
}
