<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

use acidjazz\metapi\MetApi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class TagController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MetApi;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response|JsonResponse
    {
        // $tags = Tag::where('tag_type_id', request()->tag_type_id)->get();
        $tags = Tag::get();
        return $this->render($tags);
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
    public function store(Request $request): Response|JsonResponse
    {
        return $this->update($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id): Response|JsonResponse
    {
        return $this->render(Tag::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null): Response|JsonResponse
    {
        $this
            ->option('title', 'required|string')
            ->verify();
        
        $tag = $id ? Tag::findOrFail($id) : new Tag;
        
        $tag->title = $request->title;
        $tag->tag_type_id = $request->tag_type_id;
        $tag->save();
        
        return $this->render($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->render("Deleted.");
    }
}
