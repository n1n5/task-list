<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

final class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    #[Override]
    protected $fillable = ['title', 'description', 'long_description'];

    public function toggleComplete(): void
    {
        $this->completed = ! $this->completed;
        $this->save();
    }
}
