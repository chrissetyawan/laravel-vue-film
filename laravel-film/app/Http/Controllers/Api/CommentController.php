<?php

namespace App\Http\Controllers\Api;

use App\Film;
use App\Comment;
use App\Http\Requests\Api\CreateComment;
use App\Http\Requests\Api\DeleteComment;
use App\Codeline\Transformers\CommentTransformer;

class CommentController extends ApiController
{
    /**
     * CommentController constructor.
     *
     * @param CommentTransformer $transformer
     */
    public function __construct(CommentTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except('index');
        $this->middleware('auth.api:optional')->only('index');
    }

    /**
     * Get all the comments of the film given by its slug.
     *
     * @param Film $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Film $film)
    {
        $comments = $film->comments()->get();

        return $this->respondWithTransformer($comments);
    }

    /**
     * Add a comment to the film given by its slug and return the film if successful.
     *
     * @param CreateComment $request
     * @param Film $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateComment $request, Film $film)
    {
        $comment = $film->comments()->create([
            'body' => $request->input('comment.body'),
            'user_id' => auth()->id(),
        ]);

        return $this->respondWithTransformer($comment);
    }

    /**
     * Delete the comment given by its id.
     *
     * @param DeleteComment $request
     * @param $film
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteComment $request, $film, Comment $comment)
    {
        $comment->delete();

        return $this->respondSuccess();
    }
}
