<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorizationTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Tests the API response as a guest.
     *
     * @return void
     */
    public function testAsGuest()
    {
        $response = $this->call('OPTIONS', '/');
        $actual = json_decode($response->getStatusCode());
        $expected = \Illuminate\Http\Response::HTTP_NOT_IMPLEMENTED;

        $this->assertEquals($expected, $actual);
    }
}
