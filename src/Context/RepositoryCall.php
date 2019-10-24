<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class RepositoryCall extends ComplexClassCall
{
    /**
     * @var string
     */
    public $_repository_name;

    public function onCreate(): void
    {
        $this->_instance = '$this->s(\'repository.' . $this->_repository_name . '\')->';

        parent::onCreate();
    }
}
