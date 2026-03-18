<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskUpdateNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $task;
    public $employee_id;

    public function __construct(Task $task, $employee_id = null)
    {
        $this->task = $task;
        $this->employee_id = $employee_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
       return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'status' => $this->task->status,
            'description' => $this->task->description,
            'company_id' => $this->task->company_id,
            'employee_id' => $this->employee_id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
