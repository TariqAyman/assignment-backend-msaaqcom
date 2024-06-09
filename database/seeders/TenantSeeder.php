<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Member;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        // Use the current time to generate unique subdomains
        $currentTime = Carbon::now()->timestamp;

        // Create 10 tenants
        for ($i = 1; $i <= 10; $i++) {

            $subdomain = "user{$currentTime}_{$i}";

            $tenant = Tenant::create([
                'name' => $subdomain,
                'domain' => "{$subdomain}.localhost"
            ]);

            // Use the tenant scope to seed data
            $tenant->run(function () use ($subdomain) {
                $this->seedUsers($subdomain);
                $this->seedMembers($subdomain);
                $this->seedQuizzes();
            });
        }
    }

    /**
     * Seed the users for the tenant.
     *
     * @param string $subdomain
     * @return void
     */
    private function seedUsers(string $subdomain): void
    {
        User::factory()->create([
            'name' => $subdomain,
            'email' => "{$subdomain}@quiz.com",
        ]);
    }

    /**
     * Seed the members for the tenant.
     *
     * @return void
     */
    private function seedMembers(string $subdomain): void
    {
        Member::factory()->create([
            'name' => 'member1',
            'email' => "{$subdomain}@quiz.com",
        ]);

        Member::factory()->count(10)->create();
    }

    /**
     * Seed the quizzes with questions and choices for the tenant.
     *
     * @return void
     */
    private function seedQuizzes(): void
    {
        Quiz::factory()
            ->count(rand(2, 10))
            ->has(
                Question::factory()
                    ->count(rand(5, 10))
                    ->has(
                        Choice::factory()
                            ->count(5)
                            ->sequence(fn (Sequence $sequence) => ['order' => ($sequence->index + 1) % 5])
                    )
            )
            ->create();
    }
}
