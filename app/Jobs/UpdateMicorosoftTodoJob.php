<?php

namespace App\Jobs;

use App\Models\Todo;
use App\Services\TodoService\TodoServiceFactory;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateMicorosoftTodoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly int $id, private readonly Todo $todo)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle(): void
    {
        $service = TodoServiceFactory::create('microsoft');
        $service->updateTodo($this->id, $this->todo);
    }
}
