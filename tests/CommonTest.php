<?php
/**
 * User: Артем <armit@twinscom.ru>
 */

namespace tests;


class CommonTest extends \PHPUnit_Framework_TestCase
{

    public function testUsesDefaultHandler()
    {
        $this->assertEquals(200, 200);
    }

    public function testUsesDefaultHandler1()
    {
        $this->assertEquals(200, 201);
    }

}