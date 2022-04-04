<?php

namespace App\Http\Controllers\Api;

use App\Exports\ToDoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Todo\StoreAndUpdateRequest;
use App\Http\Resources\Api\TodoResource;
use App\Imports\TodoImport;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ToDoController extends Controller
{
    public function index(): ResourceCollection
    {
        return TodoResource::collection(Todo::paginate());
    }

    public function store(StoreAndUpdateRequest $request): JsonResponse
    {
        $todo = new Todo();
        $validatedData = $request->validated();

        $todo->title = $validatedData['title'];
        $request->has('description') && $todo->description = $validatedData['description'];

        $todo->save();

        return TodoResource::make($todo)->response()->setStatusCode(201);
    }

    public function show(Todo $todo): TodoResource
    {
        return TodoResource::make($todo);
    }

    public function update(StoreAndUpdateRequest $request, Todo $todo): TodoResource
    {
        $validatedData = $request->validated();

        $todo->title = $validatedData['title'];
        $todo->description = $validatedData['description'];
        $todo->done = $validatedData['done'];

        $todo->save();

        return TodoResource::make($todo);
    }

    public function destroy(Todo $todo): Response
    {
        $todo->delete();
        return response(null, 204);
    }

    public function changeStatus(Request $request, Todo $todo): TodoResource
    {
        $todo->status = $request->input('status');

        $todo->save();

        return TodoResource::make($todo);
    }

    public function export(Request $request)
    {
        $status = $request->query('status');

        return Excel::download(new ToDoExport($status), now().$status.'todoList.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new TodoImport, $request->file('file'));
    }
}
