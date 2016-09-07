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
class Two implements PatchCompatible
{
    public function getVersion()
    {
        return 32;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f3');
        $rat->ectomy('two');

        return true;
    }
}
