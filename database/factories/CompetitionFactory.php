<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Team;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $team1Id = Team::inRandomOrder()->first()->id;
        $team2Id = Team::where('id', '!=', $team1Id)->inRandomOrder()->first()->id;
        $refereeId = User::inRandomOrder()->first()->id;

        return [
            'team1_id' => $team1Id,
            'team2_id' => $team2Id,
            'team1_score' => 0,
            'team2_score' => 0,
            'field' => fake()->word(),
            'referee_id' => $refereeId,
            'time' => fake()->dateTime(),
        ];
    }
}
