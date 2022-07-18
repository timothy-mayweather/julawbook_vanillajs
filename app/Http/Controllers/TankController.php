<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TankController extends Common
{
    public array $update_keys = ['name','description','capacity','reserve','active'];
    public array $validations = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fuel' => 'required|string',
        'capacity' => 'required|numeric',
        'reserve' => 'required|numeric',
        'active' => 'required'
    ];
    public string $modelClass = Tank::class;

    /**
     * Display the specified resource.
     * @param Request $request
     * @param string $val
     * @return Response
     */
    public function show(Request $request,string $val): Response
    {
        $tanks = (str_starts_with($val,'_'))?
            DB::table('tanks')
                ->join('branch_fuel_products','branch_fuel_products.id','=','tanks.fuel_id')
                ->join('fuel_products','fuel_products.id','=','branch_fuel_products.product_id')
                ->select('fuel_products.short_name as fuel','tanks.fuel_id','tanks.name','tanks.id','tanks.capacity','tanks.active')
                ->where('tanks.branch_id',$request->user()->branch_id)->get():

            DB::table('tanks')
            ->join('branch_fuel_products','branch_fuel_products.id','=','tanks.fuel_id')
            ->join('fuel_products','fuel_products.id','=','branch_fuel_products.product_id')
            ->select('fuel_products.short_name as fuel','tanks.fuel_id','tanks.name','tanks.id','tanks.capacity','tanks.reserve','tanks.description','tanks.active')
            ->where('tanks.branch_id',$request->user()->branch_id)->get();
        return Response($tanks);
    }

    public function in_update(string $key,Request $request, object $instance, array &$custom_validations): void
    {
        if($key==='name') {
            $tank = Tank::where([['name', '=', $request->input($key)], ['branch_id',$request->b]])->first();
            if ($tank !== null) {
                $custom_validations['name'] = ['Name is already taken!'];
            }
        }

        $instance[$key] = $request->input($key);
    }

    public function keep(Request $request, array $record, Validator $validator,$count): array
    {
        $tank = Tank::where([['name','=',$record['name']],['branch_id',$request->b]])->first();
        if($tank!==null){
            $validator->errors()->add('name','Name is already taken!');
            $validator->errors()->add('row',$count);
            return [1,$validator->errors()];
        }
        return [0,[
            //'id' => $this->AppId.($count+1).hrtime(true),
            'name' => $record['name'],
            'user_' => $request->user()->id,
            'capacity' => $record['capacity'],
            'reserve' => $record['reserve'],
            'description' => $record['description'],
            'active' => $record['active'],
            'fuel_id' => $record['fuel'],
            'branch_id' => $request->b,
        ]];
    }
}
