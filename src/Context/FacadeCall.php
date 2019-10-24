<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class FacadeCall extends ComplexClassCall
{
    /**
     * @var string
     */
    public $_facade_name;

    public function onCreate(): void
    {
        $this->_instance = '$this->s(\'facade.' . $this->_facade_name . '\')->';

        parent::onCreate();
    }
}
