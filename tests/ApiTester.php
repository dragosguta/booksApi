<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

abstract class ApiTester extends TestCase
{
    protected $fake;

    protected $times = 1;

    public function __construct() {
        $this->fake = Faker::create();
    }

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }

     public function times($count) {
        $this->times = $count;

        return $this;
    }

    public function getJson($uri) {
        return json_decode($this->call('GET', $uri)->getContent());
    }

    public function assertObjectHasAttributes() {
        $args = func_get_args();

        $object = array_shift($args);

        foreach($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

    protected function make($type, array $fields = []) {
        while($this->times--) {
            $stub = array_merge($this->getStub(), $fields);
            $type::create($stub);
        }
    }

    protected function getStub() {
        throw new BadMethodCallException('Create your own getStub method to declare fields');
    }
}
