<?php

namespace App\Http\Controllers;

use App\Services\WatchService;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    protected $watchService;

    public function __construct(WatchService $watchService)
    {
        $this->watchService = $watchService;
    }

    public function getAll()
    {
        return response()->json($this->watchService->getAll(), 200);
    }

    public function get($id)
    {
        try {
            return response()->json($this->watchService->get($id), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $watch = $this->watchService->create($request->all());
            return response()->json($watch, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->watchService->delete($id);
            return response()->json(['message' => 'Eliminado'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $watch = $this->watchService->update($request->all(), $id);
            return response()->json($watch, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}