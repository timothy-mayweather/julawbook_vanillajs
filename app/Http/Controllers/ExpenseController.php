<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExpenseController extends CommonDoubleTables
{
    use Helpers;

    public array $update_keys = ['amount','description', 'name'];
    public array $validations = [
        'amount' => 'required|numeric',
        'description' => 'string',
        'expense' => 'required|integer',
    ];

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelClass = Expense::class;
        $this->modelObject = new Expense();
        $this->modelObject->change_table();
    }

    public function keep(Request $request, array $record,$validator,$count): array
    {
        if($request->user()->manager==="No") {
            $unique_int = $record['expense'] . $request->shift . $this->date_to_int($request->data_date);
            $selected_records = $this->modelClass::select('unique_int')->where('unique_int', $unique_int)->get();
            if (count($selected_records) > 0) {
                $validator->errors()->add('expense', 'Record already exists');
                $validator->errors()->add('row', $count);
                return [1, $validator->errors()];
            }

            return [0, [
                'user_' => $request->user()->id,
                'branch_id' => $request->user()->branch_id,

                'parent_id' => $record['expense'],
                'amount' => $record['amount'],
                'description' => $record['description'],

                'shift' => $request->shift,
                'record_date' => $request->data_date,
                'user_shift_date' => $request->user()->id . $request->shift . $this->date_to_int($request->data_date),
                'unique_int' => $unique_int,
                'branch_int_date' => $request->user()->branch_id . $this->date_to_int($request->data_date),
            ]];
        }

        $unique_int = $record['expense'].$this->date_to_int($request->data_date);
        $selected_records = $this->modelObject->select('unique_int')->where('unique_int',$unique_int)->get();
        if (count($selected_records)>0){
            $validator->errors()->add('expense','Record already exists');
            $validator->errors()->add('row', $count);
            return [1,$validator->errors()];
        }

        return [0,[
            'user_' => $request->user()->id,
            'branch_id' => $request->user()->branch_id,

            'parent_id' => $record['expense'],
            'amount' => $record['amount'],
            'description' => $record['description'],

            'record_date' => $request->data_date,
            'unique_int' => $unique_int,
            'branch_int_date' => $request->user()->branch_id.$this->date_to_int($request->data_date),
        ]];
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $val
     * @return Response
     */
    public function show(Request $request,string $val): Response
    {
        if($request->user()->manager==="No") {
            return Response(DB::select("select e.id, e.amount, e.description, bet.id as expense_id, et.name from expenses e inner join branch_expense_types bet on bet.id = e.parent_id inner join expense_types et on et.id = bet.exp_id where user_shift_date=" . $request->user()->id . $request->shift . $this->date_to_int($request->data_date)));
        }
        return Response(DB::select("select e.id, e.amount, e.description, bet.id as expense_id, et.name from main_expenses e inner join branch_expense_types bet on bet.id = e.parent_id inner join expense_types et on et.id = bet.exp_id where branch_int_date=".$request->user()->branch_id.$this->date_to_int($request->data_date)));
    }

    public function in_update(string $key, Request $request,object $instance,array &$custom_validations): void
    {
        if($request->user()->manager==="No") {
            if ($key === 'name') {
                $unique_int = $request->input($key) . $request->shift . $this->date_to_int($request->data_date);
                $selected = $this->modelClass::where('unique_int', $unique_int)->get();
                if (count($selected) > 0) {
                    $custom_validations['name'] = ['Record with this name exists!'];
                }
                $instance['unique_int'] = $unique_int;
                $instance['parent_id'] = $request->input($key);
                return;
            }
        }
        else if ($key === 'name') {
            $unique_int = $request->input($key) . $this->date_to_int($request->data_date);
            $selected = $this->modelObject->where('unique_int', $unique_int)->get();
            if (count($selected) > 0) {
                $custom_validations['name'] = ['Record with this name exists!'];
            }
            $instance['unique_int'] = $unique_int;
            $instance['parent_id'] = $request->input($key);
            return;
        }
        $instance[$key] = $request->input($key);
    }
}
