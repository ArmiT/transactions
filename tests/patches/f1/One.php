<?php

/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\patches\f1;

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
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $rat = new LabRat('f1');
        $rat->inject('one');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f1');
        $rat->ectomy('one');

        return true;
    }
}
