<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\User;

class ScheduleConflictTest extends TestCase
{
    use RefreshDatabase;

    public function test_schedule_conflict_is_detected()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $program1 = Program::factory()->create();
        $program2 = Program::factory()->create();

        // Create an existing schedule
        Schedule::create([
            'program_id' => $program1->id,
            'start_time' => '2023-04-17 10:00:00',
            'end_time' => '2023-04-17 11:00:00',
        ]);

        // Attempt to create a conflicting schedule
        $response = $this->post(route('schedules.store'), [
            'program_id' => $program2->id,
            'start_time' => '2023-04-17 10:30:00',
            'end_time' => '2023-04-17 11:30:00',
        ]);

        $response->assertSessionHasErrors('conflict');
        $this->assertEquals(1, Schedule::count());
    }

    public function test_non_conflicting_schedule_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $program1 = Program::factory()->create();
        $program2 = Program::factory()->create();

        // Create an existing schedule
        Schedule::create([
            'program_id' => $program1->id,
            'start_time' => '2023-04-17 10:00:00',
            'end_time' => '2023-04-17 11:00:00',
        ]);

        // Attempt to create a non-conflicting schedule
        $response = $this->post(route('schedules.store'), [
            'program_id' => $program2->id,
            'start_time' => '2023-04-17 11:00:00',
            'end_time' => '2023-04-17 12:00:00',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('schedules.index'));
        $this->assertEquals(2, Schedule::count());
    }
}