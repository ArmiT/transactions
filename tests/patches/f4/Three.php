<?php
/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\patches\f4;

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
        return 43;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $rat = new LabRat('f4');
        $rat->inject('three');
        return true;

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f4');
        $rat->ectomy('three');
        return true;
    }

}