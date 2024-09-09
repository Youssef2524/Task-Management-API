<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AssignRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    protected $taskService;
    use AuthorizesRequests;

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks.
     *
     * @param Request $request
     * @return TaskResource
     */
  public function index(Request $request){
    try {
        $this->authorize('create', Task::class);
            $tasks = Task::query();
            if ($request->has('status')) {
            $tasks->status($request->status); 
         }
         if ($request->has('priority')) {
            $tasks->priority($request->priority); 
             }
            $tasks = $tasks->get();
                return TaskResource::collection($tasks);
    }
            catch (Exception $e) {
                    return response()->json(['error' => "$e"], 500);
    }
                }

    /**
     * Store a newly created task in storage.
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
            $task = $this->taskService->createTask($request->validated());
            return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     *
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
            $updatedTask = $this->taskService->updateTask($task, $request->validated());
            return response()->json($updatedTask);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function destroy(Task $task): JsonResponse
    {
            $this->taskService->deleteTask($task);
            return response()->json(null, 204);
       
    }

    /**
     * Assign a task to a user.
     *
     * @param AssignRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function assign(AssignRequest $request, Task $task)
    {
    
        $assigndTask = $this->taskService->assignTask($task, $request->validated());

            return new TaskResource($assigndTask);
    }
    
    public function DeletedTasks(Task $task){
        // $this->authorize('softdelete', Task::class);
        $deletedTasks = Task::onlyTrashed()->get();
        return response()->json($deletedTasks);
    }
    
    public function restoreTask($id){
        // $this->authorize('restore', Task::class);
        $task = Task::onlyTrashed()->find($id);
        if ($task) {
            $task->restore();
            return response()->json(['message' => 'Task restored successfully']);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }
    public function forceDeleteTask($id){
        $task = Task::onlyTrashed()->find($id);
        if ($task) {
            $task->forceDelete();
            return response()->json(['message' => 'Task deleted permanently']);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }

}
