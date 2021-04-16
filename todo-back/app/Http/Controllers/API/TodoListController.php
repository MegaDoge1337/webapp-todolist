<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Получить списко дел по id пользователя (GET)
     * @param Request $request
     * @return JsonResponse
     */
    public function getByUserId(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $todoList = TodoList::where('user_id', $userId)->get()->all();

        return response()->json($todoList);
    }

    /**
     * Создание пользователем задачи (POST)
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'todo_text' => ['required'],
        ]);

        $userId = $request->user()->id;

        $newTodo = TodoList::create([
            'user_id' => $userId,
            'todo_text' => $request->todo_text,
            'is_complete' => false,
        ]);

        return response()->json([
            'message' => 'New todo added.',
            'todo' => [
                'user_id' => $newTodo->user_id,
                'todo_text' => $newTodo->todo_text,
                'is_complete' => $newTodo->is_complete
            ]
        ]);
    }

    /**
     * Отметка задачи выполненной (PATCH)
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function markComplete(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()->id;

        $patchTodo = TodoList::where('user_id', $userId)
            ->where('id', $id)
            ->update(['is_complete' => 1]);

        return response()->json([
            'message' => $patchTodo ? 'Successfully todo patch.' : "Patch failed.",
            'patching_result' => $patchTodo
        ]);
    }

    public function delete(Request $request, int $id)
    {
        //TODO: Удаление задачи (DELETE)
        $userId = $request->user()->id;

        try {
            $deleteTodo = TodoList::where('user_id', $userId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        } finally {
            return response()->json([
                'message' => $deleteTodo ? 'Successfully todo deleted.' : "Delete failed.",
                'deleting_result' => $deleteTodo
            ]);
        }
    }
}
