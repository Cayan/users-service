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

    public function testReadFail()
    {
        $response = $this->call('GET', '/3');

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_BAD_REQUEST;

        $this->assertEquals($expected, $actual);
    }
}
