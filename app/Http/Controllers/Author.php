<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Author as AuthorModel;

class Author extends Controller
{
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

        $this->validate($request, $rules);

        $author = AuthorModel::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * obtains and show one author
     */
    public function show(int $id): JsonResponse
    {
        $author = AuthorModel::findOrFail($id);

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

        $this->validate($request, $rules);
        $author = AuthorModel::findOrFail($id);

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
    public function destroy(int $id): JsonResponse
    {
        $itemsRemoved = AuthorModel::destroy($id);
        if ($itemsRemoved >= 1) {
            return $this->successResponse("Author has been deleted");
        }

        return $this->errorResponse("can't delete author", Response::HTTP_NOT_FOUND);
    }
}
