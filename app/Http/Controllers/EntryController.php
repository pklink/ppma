<?php

namespace App\Http\Controllers;

use App\Model\EntryModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EntryController extends BaseController
{

    /**
     * @var array
     */
    private $validationRules = [
        'label'    => 'required',
        'password' => 'required'
    ];

    public function create(Request $request) {
        $this->validate($request, $this->validationRules);

        // save entry
        $model = new EntryModel();
        $model->label = $request->get('label');
        $model->password = $request->get('password');
        $model->save();

        // response id
        $headers = ['Locations' => sprintf('/entries/%d', $model->id)];
        return response()->json(['id' => $model->id], 201, $headers);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id) {
        // find model
        /* @var EntryModel $model */
        $model = EntryModel::find($id);

        if ($model != null) {
            $model->delete();
        }

        return response(null, 204);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {
        return response()->json(EntryModel::all());
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get($id) {
        try {
            $model = EntryModel::findOrFail($id);
            return response()->json($model);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id) {
        try {
            // find model
            /* @var EntryModel $model */
            $model = EntryModel::findOrFail($id);

            // validate request
            $this->validate($request, $this->validationRules);

            // fill model & save
            $model->label    = $request->get('label');
            $model->password = $request->get('password');
            $model->save();

            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

}
