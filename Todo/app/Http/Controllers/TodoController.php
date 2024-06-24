<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Todos/Index', [
            //'items' => Todo::with('user:id,name')->latest()->get(),
            //->where('user_id', auth()->user())
            'items' => Todo::with('user:id,name')
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->items()->create($validated);

        return Redirect::route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): RedirectResponse
    {
        Gate::authorize('update', $todo);

        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $todo->update($validated);

        return Redirect::route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): RedirectResponse
    {
        Gate::authorize('delete', $todo);

        $todo->delete();

        return Redirect::route('todos.index');
    }
}
