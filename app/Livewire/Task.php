<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task as TaskModel;
use Illuminate\Support\Facades\DB;

class Task extends Component
{
    public $newTaskName;

    public function markAsCompleteOrIncomplete($taskId)
    {
        $task = TaskModel::find($taskId);
        $task->update([
            'is_completed' => !$task->is_completed
        ]);
    }

    public function createTask()
    {
        $position = TaskModel::max('position') + 1;
        TaskModel::create([
            'name' => $this->newTaskName,
            'position' => $position,
            'is_completed' => false
        ]);

        $this->newTaskName = '';
    }

    public function deleteTask($taskId)
    {
        $currentTask = TaskModel::find($taskId);
        $currentPosition = $currentTask->position;

        DB::transaction(function () use ($currentTask, $currentPosition) {
            TaskModel::where('position', '>', $currentPosition)->decrement('position');
            $currentTask->delete();
        });
    }

    public function render()
    {
        return view('livewire.task',[
            'tasks' => TaskModel::orderBy('position')->get()
        ]);
    }
}
