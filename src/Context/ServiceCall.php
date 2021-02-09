<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class ServiceCall extends ComplexClassCall
{
    /**
     * @var string
     */
    public $_service_name;

    public function onCreate(): void
    {
        $this->_instance = '$this->s(\'' . $this->_service_name . '\')->';

        parent::onCreate();
    }
}
