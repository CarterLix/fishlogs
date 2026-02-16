<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fishlogs>
 */
class FishlogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = ["Brown Trout", "Largemouth Bass", "Muskey", "Greyling", "Carp", "Perch", "Bluegill", "Rainbow Trout", "Cutthroat Trout", "Tiger Trout", "Smallmouth Bass", "Pike", "Catfish", "Walleye", "Brook Trout", "Bull Trout"];
        $methods = ["Streamers", "Nymphing", "Dry Fly", "Spinner", "Worm", "Frog", "Trolling", "Net Cast", "Minnow", "SoftBait", "Noodling", "Jig"];
        $locations = ["Bighorn River","Lake Elmo", "Yellowstone River", "Rock Creek", "Tounge River Resivoir", "Flathead Lake", "Boulder River", "Laurel Pond", "Tounge River", "Madison River", "Big Hole River", "Clarks Fork River", "Midnight Lake", "Missouri River", "Lake Hebgen", "Yellowtail Resivouir", "Echo Lake", "Bighorn River", "Bighorn River", "Yellowstone River", "Bighorn River" ];
        return [
            //
            'date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'name' => $this->faker->name(),
            'location' => $this->faker->randomElement($locations),
            'species' => $this->faker->randomElement($species),
            'method' => $this->faker->randomElement($methods),
            'rating' => $this->faker->numberBetween(1, 10),

        ];
    }
}
