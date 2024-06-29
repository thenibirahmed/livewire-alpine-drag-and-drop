<?php

namespace App\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

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
        TaskModel::create([
            'name' => $this->newTaskName,
            'position' => 0,
            'is_completed' => false
        ]);

        $this->newTaskName = '';
    }

    public function deleteTask($taskId)
    {
        TaskModel::destroy($taskId);
    }

    public function render()
    {
        return view('livewire.task',[
            'tasks' => TaskModel::orderBy('position')->get()
        ]);
    }
}
