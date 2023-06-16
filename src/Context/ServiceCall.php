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
        $varName = '$_service_'.str_replace('.', '_', $this->_service_name);

        $this->_instance = $varName.'->';

        $this->_before_code .= "
        /** @var $varName \\{$this->_class}  */
        $varName = \$this->s('{$this->_service_name}');
        ";

        parent::onCreate();
    }
}
