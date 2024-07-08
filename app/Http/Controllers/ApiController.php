<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="Form API", version="1.0")
 */
class ApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/forms",
     *     summary="Get list of forms",
     *     @OA\Response(
     *         response=200,
     *         description="A list with forms"
     *     )
     * )
     */
    public function getForms()
    {
        return response()->json(Form::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/forms/{id}",
     *     summary="Get form by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single form",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Form not found",
     *     )
     * )
     */
    public function getForm($id)
    {
        $form = Form::find($id);
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        return response()->json($form, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/forms",
     *     summary="Create a new form",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Form")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Form created",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     )
     * )
     */
    public function createForm(Request $request)
    {
        $validatedData = $request->validate([
            'cpf' => ['required', 'unique:forms,cpf', new Cpf],
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|max:255',
            'genero' => 'required|string|max:50',
        ]);

        $form = Form::create($validatedData);
        return response()->json($form, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/forms/{id}",
     *     summary="Update an existing form",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Form")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Form updated",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Form not found",
     *     )
     * )
     */
    public function updateForm(Request $request, $id)
    {
        $form = Form::find($id);
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        $validatedData = $request->validate([
            'cpf' => ['required', 'unique:forms,cpf,' . $id, new Cpf],
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|max:255',
            'genero' => 'required|string|max:50',
        ]);

        $form->update($validatedData);
        return response()->json($form, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/forms/{id}",
     *     summary="Delete a form",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Form deleted",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Form not found",
     *     )
     * )
     */
    public function deleteForm($id)
    {
        $form = Form::find($id);
        if (!$form) {
            return response()->json(['message' => 'Form not found'], 404);
        }
        $form->delete();
        return response()->json(null, 204);
    }
}
