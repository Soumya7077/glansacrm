<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;

class role extends Controller
{
    public function index()
    {
        $role = RoleModel::all();
        if($role->count()>0)
        {
            return response()->json(['status' => 200, 'message' => 'Role list',
            'data' => $role]);
            }
            else
            {
                return response()->json(['status' => 404, 'message' => 'No role found'
                ]);
            }

        }
    }

