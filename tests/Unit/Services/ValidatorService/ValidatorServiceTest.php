<?php

namespace Tests\Unit\Services\ValidatorService;

use Illuminate\Validation\Factory;
use Presentation\Services\ValidatorService;
use Tests\TestCase;
use Presentation\Interfaces\ValidatorServiceInterface;
use Tests\Unit\UnitTestCase;

class ValidatorServiceTest extends UnitTestCase
{
    private $validator;
    private $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->validator = app()->make(ValidatorService::class);
        $this->faker = \Faker\Factory::create('es_AR');
    }

    public function testPassAllTheCorrectArguments()
    {
        $exampleOptions = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'profession' => 'carpintero',
            'email' => $this->faker->safeEmail,
            'id' => $this->faker->randomDigit
        ];

        $this->isValidWithOptions($exampleOptions,true);
    }

//    public function testPassBadName()
//    {
//        $exampleOptions = [
//            'firstName' => $this->faker->safeEmail,
//            'lastName' => $this->faker->lastName,
//            'profession' => 'carpintero',
//            'email' => $this->faker->safeEmail,
//            'id' => $this->faker->randomDigit
//        ];
//
//        $this->isValidWithOptions($exampleOptions,false);
//    }

    public function testPassFirstAndLastNameAsNumbers()
    {
        $exampleOptions = [
            'firstName' => $this->faker->randomDigit,
            'lastName' => $this->faker->randomDigit,
            'profession' => 'carpintero',
            'email' => $this->faker->safeEmail,
            'id' => $this->faker->randomDigit
        ];

        $this->isValidWithOptions($exampleOptions,false);
    }

    public function testNotPassOptional()
    {
        $exampleOptions = [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'id' => $this->faker->randomDigit
        ];

        $this->isValidWithOptions($exampleOptions,true);
    }

    private function isValidWithOptions(array $options, bool $expected)
    {
        $this->validator->make($options,$this->getGenericRules());

        $this->assertEquals($this->validator->isValid(),$expected);
    }

    /**
     * @return array
     */
    public function getGenericRules(): array
    {
        return $genericRules = [

            'firstName' => 'required|string|min:2|max:20',
            'lastName' => 'required|string|min:2|max:20',
            'profession' => 'string|min:2|max:30',
            'email' => 'required|email',
            'id' => 'numeric',
        ];
    }

    public function testGetErrorsMethods()
    {
        $exampleOptions = [
            'firstName' => $this->faker->randomDigit,
            'lastName' => $this->faker->randomDigit,
            'profession' => 'carpintero',
            'email' => $this->faker->safeEmail,
            'id' => $this->faker->randomDigit
        ];

        $this->validator->make($exampleOptions, $this->getGenericRules());


        $this->assertEquals(json_encode($this->validator->getErrors()),'{"firstName":["validation.string","validation.min.string"],"lastName":["validation.string","validation.min.string"]}');
    }
}
