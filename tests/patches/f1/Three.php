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
class Three implements PatchCompatible
{
    public function getVersion()
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $rat = new LabRat('f1');
        $rat->inject('three');
        return true;

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f1');
        $rat->ectomy('three');
        return true;
    }

}