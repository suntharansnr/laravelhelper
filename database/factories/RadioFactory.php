<?php
namespace Database\Factories;
use App\Radio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RadioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Radio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'genre_id' => 2,
            'type_id' => 2,
            'continent_id' => 2,
            'country_id' => 210,
            'state_id' => 3325,
            'city_id'  => 44892,
            'category_id' =>199,
            'language_id' => 1,
            'user_id' => 8,
            'description' => $this->faker->text,
            'stream_url' => 'http://209.133.216.3:7071/;',
            'logo' => 'images/stations/26791603463967.png'
        ];
    }
}
