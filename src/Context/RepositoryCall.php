<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\ComplexClassCall;

abstract class RepositoryCall extends ServiceCall
{
    /**
     * @var string
     */
    public $_repository_name;

    public function onCreate(): void
    {
        $this->_service_name = 'repository.' . $this->_repository_name;

        parent::onCreate();
    }
}
