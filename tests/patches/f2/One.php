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
class One implements PatchCompatible
{
    public function getVersion()
    {
        return 21;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $rat = new LabRat('f2');
        $rat->inject('one');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f2');
        $rat->ectomy('one');

        return true;
    }
}
