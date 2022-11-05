<?php

namespace App\Http\Controllers;

use App\Enums\OperationTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class TaskController extends Controller
{
    public function stage1(Request $request)
    {
        $response = ["slackUsername" => "arakunrinbambam", "backend"=> true, "age" => 30, "bio" => "I'm a tech enthusiast, I love programming and I do music at my leisure"];

        return response()->json($response);
    }

    public function stage2(Request $request)
    {

        $validated = $request->validate([
            'operation_type' => ['required', new Enum(OperationTypeEnum::class)],
            'x' => 'required|integer',
            'y' => 'required|integer'
        ]);


        $result = match($request->operation_type)
        {
            OperationTypeEnum::Addition->value => $validated['x'] + $validated['y'],
            OperationTypeEnum::Subtraction->value => $validated['x'] - $validated['y'],
            OperationTypeEnum::Multiplication->value => $validated['x'] * $validated['y'],
        };

        return response()->json(["slackUsername" => "arakunrinbambam", "result" => $result, "operation_type" => $validated['operation_type']]);


    }



}
