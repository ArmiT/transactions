<?php
/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests;

use transactions\Manager;
use transactions\storages;
use transactions\loaders;
use transactions\tests\utils;

class ErrorsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepare a rat
     * @param $generation
     * @param \Closure $onReady
     * @return utils\LabRat
     */
    protected function conductExperiment($generation, \Closure $onReady)
    {

        $rat = new utils\LabRat($generation);
        $rat->clearAnamnesis();

        $manager = new Manager(
            new storages\BasicStorage(".storage.dat"), # a concrete implementation of history storage
            new loaders\FileLoader( # a concrete implementation of vendor patches ()
                __DIR__."/patches/".$generation,
                "transactions\\tests\\patches\\".$generation
            )
        );

        $onReady($manager, $rat);

        return $rat;
    }

    /**
     * re-run attempt
     */
    public function testReRunAttempt()
    {
        $rat = new utils\LabRat('f1');
        $rat->clearAnamnesis();

        $manager = new Manager(
            new storages\BasicStorage(".storage.dat"),
            new loaders\FileLoader(
                __DIR__."/patches/f1",
                "transactions\\tests\\patches\\f1"
            )
        );

        $manager->upgrade();

        $this->assertEquals(
            $rat->inspect(),
            ["one", "two", "three"]
        );

        $manager->upgrade();

        $this->assertEquals(
            $rat->inspect(),
            ["one", "two", "three"]
        );

        $history = $manager->getHistory();

        $this->assertEquals(
            $history,
            [
                3 => [
                    'version' => 3,
                    'className' => 'transactions\tests\patches\f1\Three',
                ],
                2 => [
                    'version' => 2,
                    'className' => 'transactions\tests\patches\f1\Two',
                ],
                1 => [
                    'version' => 1,
                    'className' => 'transactions\tests\patches\f1\One',
                ]
            ]
        );

    }

    /**
     * race condition
     */
    public function testRaceCondition() {

        $this->expectException('transactions\errors\RaceConditionException');

        $this->conductExperiment('f4', function($manager) {

            $manager->upgrade();

        });
    }

    /**
     * invalid argument
     */
    public function testInvalidUpgradeCondition()
    {

        $this->expectException('\InvalidArgumentException');

        $this->conductExperiment('f1', function($manager) {

            $manager->upgrade(new \stdClass());

        });
    }

    public function testInvalidDowngradeCondition()
    {

        $this->expectException('\InvalidArgumentException');

        $this->conductExperiment('f1', function($manager) {

            $manager->upgrade();

            $manager->downgrade(new \stdClass());

        });
    }

    public function testInvalidHistoryCondition()
    {

        $this->expectException('\InvalidArgumentException');

        $this->conductExperiment('f1', function($manager) {

            $manager->upgrade();

            $manager->getHistory(new \stdClass());

        });
    }

}
