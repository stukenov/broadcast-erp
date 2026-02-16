<?php

namespace Tests\Unit;

use App\Models\Program;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProgramTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_program()
    {
        $programData = [
            'title' => 'Test Program',
            'description' => 'This is a test program',
            'duration' => 30,
            'genre' => 'Test Genre',
        ];

        $program = Program::create($programData);

        $this->assertInstanceOf(Program::class, $program);
        $this->assertEquals($programData['title'], $program->title);
        $this->assertEquals($programData['description'], $program->description);
        $this->assertEquals($programData['duration'], $program->duration);
        $this->assertEquals($programData['genre'], $program->genre);
    }
}