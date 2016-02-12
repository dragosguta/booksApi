<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;
use App\User;

abstract class ApiTester extends TestCase
{
    use Factory;

    protected $fake;
    protected $user;

    public function __construct() {
        $this->fake = Faker::create();
    }

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
        //Create a test user
        $this->user = User::create([
            'name'    => 'test',
            'email'   => 'test@test.com',
            'password'=> Hash::make('test')
        ]);
    }

    public function getJson($uri, $method = 'GET', $parameters = []) {
        if($method == 'POST')
            Auth::login($this->user);

        return json_decode($this->call($method, $uri, $parameters)->getContent());
    }

    public function assertObjectHasAttributes() {
        $args = func_get_args();

        $object = array_shift($args);

        foreach($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}
