<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCRUDFailureTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();

        factory(App\User::class)->create();
        factory(App\User::class)->create();
    }

    public function testRead()
    {
        $response = $this->call('GET', '/3');

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY;

        $this->assertEquals($expected, $actual);
    }

    public function testUpdate()
    {
        $newName = 'Daniel Pinto';
        $response = $this->call('PUT', '/', [
            'id' => 3,
            'name' => $newName
        ], [], [], $this->transformHeadersToServerVars([
            'Accept' => 'application/json',
            'CONTENT_TYPE' => 'x-www-form-urlencoded'
        ]));

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY;

        $this->assertEquals($expected, $actual);
    }
}
