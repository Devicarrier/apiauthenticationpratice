<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees =Employee::all();
        return response()->json(["Employees"=>$employees],200);
    }
    public function store(Request $request){
        $data = $request->only("emp_id","name","email","phone","gender","dob","address","destination","date_of_join","status");
        $validation = validator($data,
        [
            "emp_id"        =>  "required|unique:employees",
            "name"          =>  "required",
            "email"         =>  "required|email|unique:employees",
            "phone"         =>  "required|numeric|unique:employees",
            "dob"           =>  "required|date",
            "address"       =>  "required",
            "destination"   =>  "required",
            "date_of_join"  =>  "required|date"
        ]
    );
    if($validation->fails()){
        return response()->json(["error"=>$validation->errors()],400);
    }
        $employee = Employee::create($data);
        return response()->json("Employee Added Successfully",200);

    }
    public function show($id){
        $employee = Employee::find($id);
        if(empty($employee)){
            return response()->json("Employee not found",404);
        }
        return response()->json(["Employee"=>$employee],200);
    }
    public function update(Request $request, $id){
        $data = $request->only("emp_id","name","email","phone","gender","dob","address","destination","date_of_join","status");
        $validation = validator($data,
        [
            "emp_id"        =>  "required",
            "name"          =>  "required",
            "email"         =>  "required|email",
            "phone"         =>  "required|numeric",
            "dob"           =>  "required|date",
            "address"       =>  "required",
            "destination"   =>  "required",
            "date_of_join"  =>  "required|date"
        ]
    );
    if($validation->fails()){
        return response()->json(["error"=>$validation->errors()],400);
    }
    $employee = Employee::find($id);
    if(empty($employee)){
        return response()->json("Employee not found",404);
    }
    $employee->update($data);
    return response()->json("Employee Updated Successfully",200);
    }
    public function destroy($id){
        $employee = Employee::find($id);
        if(empty($employee)){
            return response()->json("Employee not found",404);
        }
        $employee->delete();
        return response()->json("Employee Deleted Successfully",200);

    }
}
