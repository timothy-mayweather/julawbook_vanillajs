<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class Common extends Controller
{
    public array $update_keys = [];
    public array $validations = [];
    public string $modelClass;
    public array $selectColumns = ['*'];
    public array $indexColumns;
    public array $showColumns;
    public string $showModel = 'branch_id';
    /**
     * Display the specified resource.
     * @param Request $request
     * @param string $val
     * @return Response
     */
    public function show(Request $request,string $val): Response
    {
        return Response($this->modelClass::select($this->showColumns??$this->selectColumns)->where($this->showModel,$val)->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response($this->modelClass::all($this->indexColumns??$this->selectColumns));
    }

    public function in_update(string $key, Request $request, object $instance, array &$custom_validations): void
    { $instance[$key] = $request->input($key); }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function update(Request $request, string $id): Response
    {
        $instance = $this->modelClass::find($id);

        if($instance===null){
            return Response(['record'=>['Record does not exist! Refresh']]);
        }

        $validations = []; $custom_validations = [];
        foreach ($this->update_keys as $key) {
            if ($request->has($key)) {
                $this->in_update($key,$request,$instance,$custom_validations);
                if(array_key_exists($key,$this->validations)) {
                    $validations[$key] = $this->validations[$key];
                }
            }
        }

        $validator = Validator::make($request->all(), $validations);

        if ($validator->fails()) {
            return Response($validator->errors());
        }

        if (count($custom_validations)>0) {
            return Response($custom_validations);
        }

        $instance['user_'] = $request->user()->id;
        $response = $instance->save();

        return Response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function destroy(Request $request, string $id): Response
    {
        $inst = $this->modelClass::find($id);
        $resp = 0;
        if($inst) {
            try {
                $inst->user_d = $request->user()->id;
                $inst->save();
                $resp = $inst->delete();
            } catch (QueryException $e) {
                $inst->user_d = null;
                $inst->save();
                $resp = -1;
            }
        }

        return Response('{"id":"'.$id.'","resp":'.$resp.'}');
    }

    public function keep(Request $request,array $record,\Illuminate\Contracts\Validation\Validator $validator, int $count): array
    {
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $records = $request->input('records');
        $count = 0;
        foreach ($records as $record) {
            $validator = Validator::make($record, $this->validations);

            if ($validator->fails()) {
                $validator->errors()->add('row', $count);
                return Response($validator->errors());
            }
            $arr = $this->keep($request,$record,$validator,$count);
            if($arr[0]===1){
                return Response($arr[1]);
            }
            $this->modelClass::create($arr[1]);
            $count++;
        }
        return Response(0);
    }
}
