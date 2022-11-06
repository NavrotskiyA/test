<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostCollection
     */
    public function index(Request $request)
    {
        return new PostCollection(PostsRepository::all()->paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request, string $lang)
    {
        $post = PostsRepository::create($request->rules());

        if(!$post->wasRecentlyCreated){
            $response = \response()->json([
                'code' => 401,
                'message' => 'Error, duplicate'
            ]);
        } else {
            $response = \response()->json([
                'code' => 200,
                'message' => 'Post successfully created'
            ]);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function show($lang,$id)
    {

        return PostsRepository::getPost($id) ? : response()->json(['code' => 401,'message' => 'Error, no record']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     * @todo Add validdation rules
     */
    public function update(PostRequest $request, $lang, $id)
    {
        $post = PostsRepository::update($id, $request->rules());

        if(!$post){
            $response = \response()->json([
                'code' => 401,
                'message' => 'Error, no record'
            ]);
        } else {
            $response = \response()->json([
                'code' => 200,
                'message' => 'Post successfully updated'
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
        $post = PostsRepository::delete($id);

        if($post){
            $response = \response()->json([
                'code' => 200,
                'message' => 'Successfully deleted',
                'id' => $id
            ]);
        } else{
            $response = \response()->json([
                'code' => 404,
                'message' => 'Error, post not found',
                'id' => $id
            ]);
        }
        return $response;
    }
}
