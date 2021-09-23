<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Repository\JobRepositoryInterface;
use Illuminate\Http\Request;

class JobController extends Controller
{

    private $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->jobRepository->paginate();

        return view('jobs.index', compact('jobs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function list() {
        $jobs_lists = $this->jobRepository->all();

        return view('jobs.list', compact('jobs_lists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {

            $imageName = time() . '.' . $image->extension();
            $path      = $image->storeAs(
                'uploades', $imageName
            );
            $input['image'] = $path;
        }

        $this->jobRepository->store($input);

        return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job = $this->jobRepository->find($job->id);

        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $job = $this->jobRepository->find($job->id);

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            // ====== as usual method ==========
            // $destinationPath = 'image/';
            // $profileImage    = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
            // $input['image'] = "$profileImage";

            // ========= store with name method ==================
            $imageName = time() . '.' . $image->extension();
            $path      = $image->storeAs(
                'uploades', $imageName
            );
            $input['image'] = $path;

            // =========== store without name method =============
            // $input['image'] = $request->file('image')->store('uploades');

        } else {
            unset($input['image']);
        }

        $this->jobRepository->update($job->id, $input);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $this->jobRepository->destroy($job->id);

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
