<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Person;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = User::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Create a user factory for admins
     */
    public function admins(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'person_id' => Person::factory(),
                'role_id' => config('const.user_role.admin'),
                'username' => 'admin',
                'email' => 'admin@chronostep.com',
                'password' => 'test1234'
            ];
        })->afterCreating(function (User $user) {
            $user->update([
                'username' => 'admin' . $user->id,
                'email' => 'admin' . $user->id . '@chronostep.com'
            ]);
        });
    }

    /**
     * Create a user factory for members
     */
    public function members(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'person_id' => Person::factory(),
                'role_id' => config('const.user_role.member'),
                'username' => 'member',
                'email' => 'member@chronostep.com',
                'password' => 'test1234'
            ];
        })->afterCreating(function (User $user) {
            $user->update([
                'username' => 'member' . $user->id,
                'email' => 'member' . $user->id . '@chronostep.com'
            ]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
