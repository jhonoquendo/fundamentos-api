<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post as PostRequests;
use App\Http\Resources\Post as PostResources;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{

    protected $post;

    /*
        1XX:     Informativo,
        2XX:     Respuesta exitosa,
        3XX:     Redireccion,
        4XX:     Errores del cliente,
        5XX:     Errores del servidor,

    */

    public function __construct(Post $post){
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new PostCollection($this->post->orderBy('id','desc')->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequests $request)
    {
        $post = $this->post->create($request->all());

        return response()->json(new PostResources($post),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json(new PostResources($post));
        /*return [
            'id' => $post->id,
            'post_name' => strtoupper($post->title),
            'post_body' => strtoupper(substr($post->body,0,240).'...')
        ];*/
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequests $request, Post $post)
    {
        $post->update($request->all());

        return response()->json(new PostResources($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null,204);
    }
}
