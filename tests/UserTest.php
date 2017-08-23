<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetContacts()
    {
        $contact_obj = new \App\Http\Controllers\ContactController;
        $contact = $contact_obj->getContacts();
        $this->assertEquals('2', count($contact));
    }

    public function testContactController()
    {
        $response  = $this->call('get','/');

        $this->assertEquals('200', $response->status());

        $this->seeInDatabase('contacts', [
            'email' => 'sarwar.naseem@gmail.com'
        ]);
    }
}
