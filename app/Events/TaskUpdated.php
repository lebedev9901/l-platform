<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdated implements ShouldBroadcast
{
    use  SerializesModels;

    /**
     * Create a new event instance.
     */
    public $task;
    public $employee_id;
    public function __construct(Task $task, $employee_id = null)
    {
        $this->task = $task;
        $this->employee_id = $employee_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('company.' . $this->task->company_id),
        ];
    }

    public function broadcastWith()
    {
        return[
            'id' => $this->task->id,
            'title' => $this->task->title,
            'status' => $this->task->status,
            'description' => $this->task->description,
            'deadline' => $this->task->deadline?->format('Y-m-d H:i'),
            'employee_id' => $this->employee_id,
            'tasks_count' => $this->task->employees()->count(),
            'tasks_in_progress_count' => $this->task->employees()->wherePivot('status', 'В работе')->count(),
            'tasks_done_count' => $this->task->employees()->wherePivot('status', 'Выполнено')->count(),
            'overdue_tasks_count' => $this->task->employees()
                ->wherePivot('status', '!=', 'Выполнено')
                ->where('deadline', '<', now())
                ->count()
        ];
    }
}
