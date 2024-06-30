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

    public function sortItem($taskId, $newPosition)
    {
        $task = TaskModel::find($taskId);
        $currentPosition = $task->position;
        $newPosition = $newPosition + 1;

        if( $currentPosition === $newPosition ) return;

        $task->update([
            'position' => -1
        ]);

        $tasksWhichNeedsToBeShifted = TaskModel::whereBetween('position', [
            min($currentPosition, $newPosition),
            max($currentPosition, $newPosition)
        ]);

        if( $currentPosition < $newPosition ){
            $tasksWhichNeedsToBeShifted->decrement('position');
        }else{
            $tasksWhichNeedsToBeShifted->increment('position');
        }

        $task->update([
            'position' => $newPosition
        ]);
    }

    public function render()
    {
        return view('livewire.task',[
            'tasks' => TaskModel::orderBy('position')->get()
        ]);
    }
}
