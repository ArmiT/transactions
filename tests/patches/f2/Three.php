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
class Three implements PatchCompatible
{
    public function getVersion()
    {
        return 23;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $rat = new LabRat('f2');
        $rat->inject('three');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f2');
        $rat->ectomy('three');

        return true;
    }
}
