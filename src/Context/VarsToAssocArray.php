<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Context;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;
use Perfumerlabs\Perfumer\LocalVariable;

abstract class VarsToAssocArray extends Code
{
    /**
     * @var \ReflectionMethod
     */
    private $reflection_method;

    public function onAnalyze(): void
    {
        parent::onAnalyze();

        $variable = new LocalVariable();
        $variable->name = $this->out;

        $this->getMethodData()->addLocalVariable($variable);

        $reflection_class = new \ReflectionClass($this->_class);

        foreach ($reflection_class->getMethods() as $method) {
            if ($method->getName() === $this->_method) {
                $this->reflection_method = $method;
            }
        }

        if ($this->reflection_method) {
            foreach ($this->reflection_method->getParameters() as $parameter) {
                $this->getMethodData()->requireLocalVariable($parameter->getName());
            }
        }
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $code = sprintf('$%s = [', $this->out);

        foreach ($this->reflection_method->getParameters() as $parameter) {
            $code .= sprintf('\'%s\' => $%s,', $parameter->getName(), $parameter->getName());
        }

        $code .= '];';

        $this->_code = $code;
    }
}
