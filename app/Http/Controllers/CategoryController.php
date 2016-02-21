<?php

namespace App\Http\Controllers;

use App\Http\Response\CollectionResponse;
use App\Model\CategoryModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CategoryController extends BaseController
{

    /**
     * @var array
     */
    private $validationRules = [
        'name' => 'required'
    ];

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request) {
        $this->validate($request, $this->validationRules);

        // save entry
        $model = new CategoryModel();
        $model->name      = $request->get('name');
        $model->parent_id = $request->get('parent_id');
        $model->save();

        // response id
        $headers = ['Location' => sprintf('/categories/%d', $model->id)];
        return response()->json($model, 201, $headers);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id) {
        // find model
        /* @var CategoryModel $model */
        $model = CategoryModel::find($id);

        if ($model != null) {
            $model->delete();
        }

        return response(null, 204);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get($id) {
        try {
            $model = CategoryModel::findOrFail($id);
            return response()->json($model);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request) {
        $query = CategoryModel::query();

        // Sorting
        $sort = $request->get('s', 'id');
        $direction = $request->get('d', 'desc');
        $query->orderBy($sort, $direction);

        return response()->json(new CollectionResponse($query->get()));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id) {
        try {
            // find model
            /* @var CategoryModel $model */
            $model = CategoryModel::findOrFail($id);

            // validate request
            $this->validate($request, $this->validationRules);

            // fill model & save
            $model->name = $request->get('name');
            $model->save();

            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

}
