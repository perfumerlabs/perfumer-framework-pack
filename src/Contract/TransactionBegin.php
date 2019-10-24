<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class TransactionBegin extends Code
{
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
