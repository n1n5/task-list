<?php

declare(strict_types=1);

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Task Model', function (): void {

    describe('fillable attributes', function (): void {
        it('has the correct fillable attributes', function (): void {
            $task = new Task();

            expect($task->getFillable())->toBe(['title', 'description', 'long_description']);
        });

        it('can be created with mass assignment', function (): void {
            $task = Task::query()->create([
                'title' => 'Test Task',
                'description' => 'Short description',
                'long_description' => 'A longer description of the task',
            ]);

            expect($task)
                ->title->toBe('Test Task')
                ->description->toBe('Short description')
                ->long_description->toBe('A longer description of the task');
        });

    });

    describe('toggleComplete', function (): void {
        it('marks an incomplete task as complete', function (): void {
            $task = Task::query()->create([
                'title' => 'Test Task',
                'description' => 'Description',
                'long_description' => 'Long description',
            ]);

            expect($task->completed)->toBeFalsy();

            $task->toggleComplete();

            expect($task->completed)->toBeTruthy();
        });

        it('marks a complete task as incomplete', function (): void {
            $task = Task::query()->create([
                'title' => 'Test Task',
                'description' => 'Description',
                'long_description' => 'Long description',
                'completed' => true,
            ]);

            $task->toggleComplete();

            expect($task->completed)->toBeFalsy();
        });

        it('persists the toggled state to the database', function (): void {
            $task = Task::query()->create([
                'title' => 'Test Task',
                'description' => 'Description',
                'long_description' => 'Long description',
            ]);

            $task->toggleComplete();

            expect(Task::query()->find($task->id)->completed)->toBeTruthy();
        });

        it('can toggle multiple times', function (): void {
            $task = Task::query()->create([
                'title' => 'Test Task',
                'description' => 'Description',
                'long_description' => 'Long description',
            ]);

            $task->toggleComplete();

            expect($task->completed)->toBeTruthy();

            $task->toggleComplete();
            expect($task->completed)->toBeFalsy();

            $task->toggleComplete();
            expect($task->completed)->toBeTruthy();
        });
    });

    describe('factory', function (): void {
        it('can be created via factory', function (): void {
            $task = Task::factory()->create();

            expect($task)->toBeInstanceOf(Task::class)
                ->and($task->exists)->toBeTrue();
        });
    });
});
