<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCRUDTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();

        factory(App\User::class)->create();
        factory(App\User::class)->create();
    }

    /**
     * Fetching all users.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', '/');
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content, 'Invalid JSON');

        $actual = count($content);
        $expected = 2;

        $this->assertEquals($expected, $actual);
    }
/*
    public function testRead()
    {
        // TBI
    }

    public function testCreate()
    {
        // TBI
    }

    public function testUpdate()
    {
        // TBI
    }

    public function testDelete()
    {
        // TBI
    }
*/
}
