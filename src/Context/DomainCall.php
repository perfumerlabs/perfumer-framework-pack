<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class DomainCall extends ServiceCall
{
    /**
     * @var string
     */
    public $_domain_name;

    public function onCreate(): void
    {
        $this->_service_name = 'domain.' . $this->_domain_name;

        parent::onCreate();
    }
}
