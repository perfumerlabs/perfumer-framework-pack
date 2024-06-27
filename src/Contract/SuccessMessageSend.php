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
class SuccessMessageSend extends Code
{
    use ArgumentParseTrait;

    public function __construct(
        public $_values = null,
        ...$_args
    )
    {
        $_args = $this->parseArgument($this->_values, $_args, []);
        parent::__construct(...$_args);
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code = 'if ($_success_message) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->getView()->setSuccessMessage($this->s(\'translator\')->trans($_success_message));
        }';
    }
}
