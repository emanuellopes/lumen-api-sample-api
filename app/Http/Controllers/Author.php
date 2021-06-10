<?php

namespace App\Http\Controllers;

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
    public function show(int $id): Response
    {

    }

    /**
     * update one author
     */
    public function update(Request $request, int $id): Response
    {

    }


    /**
     * delete on authors
     */
    public function destroy(int $id): Response
    {

    }
}
