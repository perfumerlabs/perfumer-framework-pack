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
class TransactionBegin extends Code
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

    public function onCreate(): void
    {
        $this->_is_validatable = false;

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code =
            '$con = \\Propel\\Runtime\\Propel::getWriteConnection(\\Perfumerlabs\\Start\\Model\\Map\\UserTableMap::DATABASE_NAME);
            $con->beginTransaction();
        
            try {';
    }
}
