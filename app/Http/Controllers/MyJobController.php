<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyJobController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAnyEmployer',Job::class);
        return view(
            'my_job.index',
            [
                'jobs'=>auth()->user()->employer
                    ->jobs()
                    ->with('employer','jobApplications','jobApplications.user')
                    ->withTrashed()
                    ->get()
            ]
        );
    }

    public function create()
    {
        $this->authorize('create',Job::class);
        return view('my_job.create');
        
    }
    public function store(JobRequest $request)
    {
        // $validatedData =$request->validate([
        //     'title'=>'required|string|max:255',
        //     'location'=>'required|string|max:255',
        //     'salary'=>'required|numeric|min:5000',
        //     'description'=>'required|string',
        //     'experience'=>'required|in:' .implode(',',Job::$experience),
        //     'category'=>'required|in:' .implode(',',Job::$category),
        // ]);

        $this->authorize('store',Job::class);
        
        auth()->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success','Job created successfully.');
    }

    public function edit(Job $myJob)
    {
        $this->authorize('update',$myJob);

        return view('my_job.edit',['job'=> $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize('update',$myJob);

        $myJob->update($request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success','Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()->route('my-jobs.index')
             ->with('success','Job Deleted.');
    }
}
