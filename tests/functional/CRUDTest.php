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

    public function testRead()
    {
        $response = $this->call('GET', '/2');
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content, 'Invalid JSON');

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_OK;

        $this->assertEquals($expected, $actual);

        $actual = $content['id'];
        $expected = 2;

        $this->assertEquals($expected, $actual);
    }

    public function testReadFail()
    {
        $response = $this->call('GET', '/3');

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_BAD_REQUEST;

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $password = str_random(20);
        $params = array_merge(factory(App\User::class)->make()->toArray(), [
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response = $this->call('POST', '/', $params);

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_NO_CONTENT;

        $this->assertEquals($expected, $actual);

        $response = $this->call('GET', '/');
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content, 'Invalid JSON');

        $actual = count($content);
        $expected = 3;

        $this->assertEquals($expected, $actual);
    }

    public function testUpdate()
    {
        $newName = 'Daniel Pinto';
        $response = $this->call('PUT', '/', [
            'id' => 2,
            'name' => $newName
        ], [
            'CONTENT_TYPE' => 'x-www-form-urlencoded'
        ]);

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_NO_CONTENT;

        $response = $this->call('GET', '/2');
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content, 'Invalid JSON');

        $actual = $content['name'];
        $expected = $newName;

        $this->assertEquals($expected, $actual);
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/', ['id' => 2]);

        $actual = $response->getStatusCode();
        $expected = \Illuminate\Http\Response::HTTP_NO_CONTENT;

        $response = $this->call('GET', '/');
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content, 'Invalid JSON');

        $actual = count($content);
        $expected = 1;

        $this->assertEquals($expected, $actual);
    }
}
