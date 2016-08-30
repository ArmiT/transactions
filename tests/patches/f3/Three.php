<?php
/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\patches\f3;

use transactions\PatchCompatible;
use transactions\tests\utils\LabRat;

/**
 * Class One
 *
 * {@inheritdoc}
 */
class Three implements PatchCompatible
{
    public function getVersion()
    {
        return 33;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $rat = new LabRat('f3');
        $rat->inject('three');
        return true;

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f3');
        $rat->ectomy('three');
        return true;
    }

}