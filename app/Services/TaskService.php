<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskService
{
    use AuthorizesRequests;

    /**
     * Get all tasks with optional filtering.
     *
     * @param array $filters
     * @return Collection
     */
    

    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        try {
            $this->authorize('create', Task::class);

        return Task::create([
            'title' => $data['title'],
            'description' =>$data['description'],
            'priority' => $data['priority'],
            'due_date' =>$data['due_date'],
            'status' =>$data['status'],
            'assigned_to' => null,           
        ]);
    } catch (Exception $e) {
        return response()->json(['error' => "$e"], 500);
    }
        // return Task::create($data);
    }

    /**
     * Update an existing task.
     *
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data): Task
    {
        try {
            $this->authorize('update', $task);

        $task->update($data);
     
        return $task;
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to update task'], 500);
    }
    }

    /**
     * Delete a task.
     *
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task): bool
    {
        try {
            $this->authorize('delete', Task::class);
        return $task->delete();
    
} catch (Exception $e) {
    return response()->json(['error' => 'Failed to delete task'], 500);
}

}
    public function assignTask(Task $task, array $data)
    {
        try {
            $this->authorize('assign', $task);
            $task->update($data);
            return $task;
    
} catch (AuthorizationException $e) {
    return response()->json(['error' => 'You are not authorized to assign this task'], 403);
} 

}
}