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
                $parameter_name = $parameter->getName();
                $in_parameter_name = 'in_' . $parameter->getName();

                $parameter_value = $this->$in_parameter_name ?: $this->$parameter_name;

                if (!$parameter_value) {
                    $parameter_value = $parameter->getName();
                }

                $this->getMethodData()->requireLocalVariable($parameter_value);
            }
        }
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $code = sprintf('$%s = [', $this->out);

        foreach ($this->reflection_method->getParameters() as $parameter) {
            $parameter_name = $parameter->getName();
            $in_parameter_name = 'in_' . $parameter->getName();

            $parameter_value = $this->$in_parameter_name ?: $this->$parameter_name;

            if (!$parameter_value) {
                $parameter_value = $parameter->getName();
            }

            $code .= sprintf('\'%s\' => $%s,', $parameter->getName(), $parameter_value);
        }

        $code .= '];';

        $this->_code = $code;
    }
}
