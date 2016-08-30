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
class One implements PatchCompatible
{

    public function getVersion()
    {
        return 31;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $rat = new LabRat('f3');
        $rat->inject('one');
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $rat = new LabRat('f3');
        $rat->ectomy('one');
        return true;
    }

}