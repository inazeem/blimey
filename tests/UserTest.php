<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $contact_obj = new \App\Http\Controllers\ContactController;
        $contact = $contact_obj->getContacts();
        $this->assertEquals('2', count($contact));
        //$this->assertTrue(true);
    }
}
