<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractClassAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
#[\Attribute(
    \Attribute::TARGET_CLASS
)]
class Controller extends ContractClassAnnotation
{
    public function onBuild(): void
    {
        parent::onBuild();

        $this->getBaseClassData()->addTag('controller');
    }
}
