<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function department()
    {
        return view('screens.Department.department');
    }
    public function index($id = null)
    {
        if ($id !== null) {
            // Fetch single user by ID
            try {
                $department = DepartmentModel::findOrFail($id);
                return response()->json([
                    'status' => 200,
                    'data' => $department,
                ], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 404,
                    'message' => "Department with the given ID not found",
                ], 404);
            }
        } else {
            // Fetch all users
            $alldepartment = DepartmentModel::all();
            if ($alldepartment->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => "No Departent found",
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'data' => $alldepartment,
            ], 200);
        }
    }

    public function store(Request $request)
{
    try {
        // Check if department name already exists
        $name = DepartmentModel::where('Name', $request->name)->exists();
        
        if ($name) {
            return response()->json([
                'status' => 400,
                'message' => 'Department name already exists',
            ], 400);
        }
        
        // Create the department
        $department = DepartmentModel::create([
            'Name' => $request->input('name'),
        ]);
        
        if ($department) {
            return response()->json([
                'status' => 200, // HTTP status code 201 for resource creation
                'message' => 'Department created successfully',
                'data' => $department,
            ], 201);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create department',
            ], 500);
        }
    } catch (Exception $e) {
        // Handle the exception and return error details
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong! Please try again.',
            'error' => $e->getMessage(),
        ], 500); // Internal Server Error status code
    }
}

    public function update(Request $request, $id)
    {
        try {
            // Find the department
            $department = DepartmentModel::find($id);

            if (!$department) {
                return response()->json([
                    'status' => 404,
                    'message' => "No Department found",
                ], 404);
            }

            // Update the department
            $department->update(
                [
                    'Name' => $request->input('name'),
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Department updated successfully',
                'data' => $department,
            ], 200);
        } catch (Exception $e) {
            \Log::error('Error updating department: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        // This method is not implemented
        $department = DepartmentModel::find($id);
        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }
        $department->delete();
        return response()->json(['message' => 'Department deleted successfully'], 200);
    }
}
