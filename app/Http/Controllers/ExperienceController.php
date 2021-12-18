<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Http\Requests\ExperienceRequest;

use acidjazz\metapi\MetApi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class ExperienceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MetApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::all();
        return $this->render($experiences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceRequest $request)
    {
        return $this->update($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->render(Experience::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null): Response|JsonResponse
    {
        $this
            ->option('company', 'required|string')
            ->option('role', 'required|string')
            // ->option('date_start', 'required|date')
            ->verify();

        
        $experience = $id ? Experience::findOrFail($id) : new Experience;
        
        $experience->company = $request->company;
        $experience->role = $request->role;
        $experience->date_start = $request->date_start;
        $experience->date_end = $request->date_end;
        $experience->save();
        
        return $this->render($experience);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        return $this->render("Deleted.");
    }

    public function error(): Response|JsonResponse
    {
        return $this->render(['forced_error' => $forced_error]);
    }
    
}
