<?php
/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\patches\f4;

use transactions\Manager;
use transactions\PatchCompatible;
use transactions\storages;
use transactions\loaders;

/**
 * Class One
 *
 * {@inheritdoc}
 */
class Two implements PatchCompatible
{
    public function getVersion()
    {
        return 42;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $manager = new Manager(
            new storages\BasicStorage(".storage.dat"),
            new loaders\FileLoader(
                __DIR__."/patches/f1",
                "transactions\\tests\\patches\\f1"
            )
        );

        $manager->upgrade();

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        return true;
    }

}