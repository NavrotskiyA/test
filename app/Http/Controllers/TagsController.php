<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsRequest;
use App\Http\Resources\TagCollection;
use App\Models\Post;
use App\Repositories\TagsRepository;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TagCollection
     */
    public function index($lang)
    {
        return new TagCollection(TagsRepository::all()->paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     * @param TagsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagsRequest $request, $lang)
    {
        TagsRepository::create($request->rules());

        return \response()->json([
            'code' => 200,
            'message' => 'Successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return TagsRepository::getTag($id) ?  : response()->json(['code' => 401,'message' => 'Error, no record']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagsRequest $request, $id)
    {
        $tag = TagsRepository::update($id, $request->rules());
        if(!$tag){
            $response = \response()->json([
                'code' => 401,
                'message' => 'Error, no record'
            ]);
        } else {
            $response = \response()->json([
                'code' => 200,
                'message' => 'Tag successfully updated'
            ]);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tag = TagsRepository::delete($id);
        if($tag){
            $response = \response()->json([
                'code' => 200,
                'message' => 'Successfully deleted',
                'id' => $id
            ]);
        } else{
            $response = \response()->json([
                'code' => 401,
                'message' => 'Error, tag not found',
                'id' => $id
            ]);
        }
        return $response;
    }
}
