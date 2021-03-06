<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $continents = [
            'Europe',
            'Asia',
            'USA',
        ];
        shuffle($continents);
        $continent = array_shift($continents);
        return [
            'name' => $this->faker->unique()->country . microtime(),
            'continent_name' => $continent,
        ];
    }
}
