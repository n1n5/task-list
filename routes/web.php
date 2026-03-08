<?php

declare(strict_types=1);

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => to_route('tasks.index'));

Route::get('/tasks', fn (): Factory|View => view('index', ['tasks' => Task::query()->latest()->paginate(10)]))->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', fn (Task $task): Factory|View => view('edit', ['task' => $task]))->name('tasks.edit');

Route::get('/tasks/{task}', fn (Task $task): Factory|View => view('show', ['task' => $task]))->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::query()->create($request->validated());

    return to_route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return to_route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return to_route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

Route::fallback(fn (): string => 'Still got somewhere!');
