<?php

/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests;

use transactions\loaders;
use transactions\Manager;
use transactions\storages;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepare a rat
     *
     * @param $generation
     * @param \Closure $onReady
     *
     * @return utils\LabRat
     */
    protected function conductExperiment($generation, \Closure $onReady)
    {
        $rat = new utils\LabRat($generation);
        $rat->clearAnamnesis();

        $manager = new Manager(
            new storages\BasicStorage('.storage.dat'), // a concrete implementation of history storage
            new loaders\FileLoader(// a concrete implementation of vendor patches ()
                __DIR__.'/patches/'.$generation,
                'transactions\\tests\\patches\\'.$generation
            )
        );

        \Closure::bind($onReady, $this, $this);

        $onReady($manager, $rat);

        return $rat;
    }

    /**
     * full sequential
     */
    public function testValidSafeLaunch()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade(); // apply all available migrations to the target system

            $this->assertEquals(
                $rat->inspect(),
                [
                    'one',
                    'two',
                    'three',
                ]
            );
        });
    }

    /**
     * Exception handling
     */
    public function testInvalidSafeLaunch()
    {
        $this->conductExperiment('f2', function ($manager, $rat) {
            $manager->upgrade();

            $this->assertEquals(
                $rat->inspect(),
                []
            );
        });
    }

    /**
     * Unsuccessful result
     */
    public function testInvalidSafeLaunch2()
    {
        $this->conductExperiment('f3', function ($manager, $rat) {
            $manager->upgrade();

            $this->assertEquals(
                $rat->inspect(),
                []
            );
        });
    }

    /**
     * Partial sequential upgrade
     */
    public function testLaunchWithPartialApplying()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade(2);

            $this->assertEquals(
                $rat->inspect(),
                ['one', 'two']
            );
        });
    }

    /**
     * Partial sequential downgrade
     */
    public function testLaunchWithPartialDowngrade()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade(3);

            $this->assertEquals(
                $rat->inspect(),
                ['one', 'two', 'three']
            );

            $manager->downgrade(2);
            $this->assertEquals(
                $rat->inspect(),
                ['one']
            );
        });
    }

    /**
     * full sequential downgrade
     */
    public function testLaunchWithFullDowngrade()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade();

            $this->assertEquals(
                $rat->inspect(),
                ['one', 'two', 'three']
            );

            $manager->downgrade();
            $this->assertEquals(
                $rat->inspect(),
                []
            );
        });
    }

    /**
     * Full history
     */
    public function testGetFullHistory()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade();

            $this->assertEquals(
                $rat->inspect(),
                ['one', 'two', 'three']
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
                    ],
                ]
            );
        });
    }

    /**
     * part of a history
     */
    public function testGetPartStory()
    {
        $this->conductExperiment('f1', function ($manager, $rat) {
            $manager->upgrade();

            $this->assertEquals(
                $rat->inspect(),
                ['one', 'two', 'three']
            );

            $history = $manager->getHistory(2);

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
                ]
            );
        });
    }
}
