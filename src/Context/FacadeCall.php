<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class FacadeCall extends ServiceCall
{
    /**
     * @var string
     */
    public $_facade_name;

    public function onCreate(): void
    {
        $this->_service_name = 'facade.' . $this->_facade_name;

        parent::onCreate();
    }
}
