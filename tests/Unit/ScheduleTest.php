<?php

namespace Tests\Unit;

use App\Models\Schedule;
use App\Models\Program;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_schedule()
    {
        $program = Program::factory()->create();

        $scheduleData = [
            'program_id' => $program->id,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addHours(2),
        ];

        $schedule = Schedule::create($scheduleData);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertEquals($scheduleData['program_id'], $schedule->program_id);
        $this->assertEquals($scheduleData['start_time']->toDateTimeString(), $schedule->start_time->toDateTimeString());
        $this->assertEquals($scheduleData['end_time']->toDateTimeString(), $schedule->end_time->toDateTimeString());
    }
}