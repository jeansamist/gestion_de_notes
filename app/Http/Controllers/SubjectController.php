<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        return view('subjects.create');
    }


    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name'         => 'required|string|max:255',

        ]);

        // Create the subject
        Subject::create([
            'name'         => $validated['name'],
            'code'         => uniqid(),

        ]);

        // Redirect with a success message
        return redirect()->route('subjects.create')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\View\View
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // Find the subject to update
        $subject = Subject::findOrFail($id);
        
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the subject
        $subject->update([
            'name' => $validated['name'],
        ]);

        // Redirect with a success message
        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        // Delete the subject
        $subject->delete();

        // Redirect with a success message
        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
