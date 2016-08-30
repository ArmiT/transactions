<?php
/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\patches\f2;

use transactions\PatchCompatible;
use transactions\tests\utils\LabRat;

/**
 * Class One
 *
 * {@inheritdoc}
 */
class Two implements PatchCompatible
{
    public function getVersion()
    {
        return 22;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        throw new \ErrorException('some error');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f2');
        $rat->ectomy('two');
        return true;
    }

}