<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class Content extends Code
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    public function onBuild(): void
    {
        parent::onBuild();

        $value = $this->value ?: $this->name;

        if ($this->name) {
            $this->_code = sprintf('$_content[\'%s\'] = $%s;', $this->name, $value);
        } else {
            $this->_code = sprintf('$_content = $%s;', $value);
        }
    }
}
