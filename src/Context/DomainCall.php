<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class DomainCall extends ComplexClassCall
{
    /**
     * @var string
     */
    public $_domain_name;

    public function onCreate(): void
    {
        $this->_instance = '$this->s(\'domain.' . $this->_domain_name . '\')->';

        parent::onCreate();
    }
}
