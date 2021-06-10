<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Author as AuthorModel;
use Illuminate\Validation\ValidationException;

class Author extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Return the list of authors
     *
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(AuthorModel::all());
    }

    /**
     * Create one new author
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name'    => 'required|max:255|string|unique:authors',
            'gender'  => 'required|max:255|in:male,female',
            'country' => 'required|max:255|string|in:PT,US,CH',
        ];

        try {
            $this->validate($request, $rules);
        } catch (ValidationException $e) {
            return $this->errorResponse($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        $author = AuthorModel::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * obtains and show one author
     */
    public function show(int $id): JsonResponse
    {
        try {
            $author = AuthorModel::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($author);
    }

    /**
     * update one author
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $rules = [
            'name'    => 'max:255|string',
            'gender'  => 'max:255|in:male,female',
            'country' => 'size:2|string|in:PT,US,CH',
        ];

        try {
            $this->validate($request, $rules);
            $author = AuthorModel::findOrFail($id);
        } catch (ValidationException $e) {
            return $this->errorResponse($e->errors(), Response::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse("As leat one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ( ! $author->save()) {
            return $this->errorResponse("User not saved", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->successResponse($author);
    }


    /**
     * delete on authors
     */
    public function destroy(int $id): Response
    {

    }
}
