<?php

namespace App\Http\Controllers;

use App\Http\Response\CollectionResponse;
use App\Model\CategoryModel;
use App\Model\EntryModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request) {
        /* @var \Illuminate\Validation\Factory $validationFactory */
        $validationFactory = app('validator');

        // create validator
        $validator = $validationFactory->make($request->all(), [
            'name' => 'required',
        ]);

        // check if validation runs fine
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // save entry
        $model = new CategoryModel();
        $model->name = $request->get('name');
        $model->save();

        // response id
        $headers = ['Locations' => sprintf('/categories/%d', $model->id)];
        return response()->json(['id' => $model->id], 201, $headers);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {
        return response()->json(new CollectionResponse(CategoryModel::all()));
    }

    public function get($id) {
        try {
            $model = EntryModel::findOrFail($id);
            return response()->json($model);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'entry not found'], 404);
        }


        return response()->json();
    }

}
