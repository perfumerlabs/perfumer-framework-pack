<?php

namespace Perfumerlabs\PerfumerFrameworkPack\Contract;

use Perfumerlabs\Perfumer\ContractAnnotation\Code;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD", "ANNOTATION"})
 */
class TransactionEnd extends Code
{
    public function onCreate(): void
    {
        $this->_is_validatable = false;

        parent::onCreate();
    }

    public function onBuild(): void
    {
        parent::onBuild();

        $this->_code =
            '$con->commit();
            } catch (\Throwable $e) {
                $con->rollBack();
                
                if ($this->getApplication()->getBuildType() === \'dev\') {
                    throw $e;
                }
            
                $this->setErrorMessageAndExit(\'Error 500\');
            }';
    }
}
