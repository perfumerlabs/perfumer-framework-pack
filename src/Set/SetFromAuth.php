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
class SetFromAuth extends Set
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

        $code = '$' . $this->name . ' = $this->getAuth();';

        $this->_code = $code;

        $id = '_auth';

        $this->setId($id);
    }
}
