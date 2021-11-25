<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    function index()
    {
        $patients = Patient::all();

        $semua = count($patients);

        if ($semua) {
            $data = [
                'message' => 'Get All Resource',
                'semua' => $semua,
                'data' => $patients
            ];

            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Data is empty'
            ];

            return response()->json($data, 200);
        }
    }

    function store(Request $request, $id) 
    {
        $patients = Patient::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at
        ]);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patients
        ];

        return response()->json($data, 201);

    }

    function show($id)
    {
        $patients = Patient::find($id);

        # Jika data ada, maka kembalikan data tersebut
        # Jika tidak ada, maka kembalikan pesan tidak ada

        if ($patients) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $patients
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);

        }
    }

    function update(Request $request, $id)
    {
        $patients = Patient::find($id);

        # Jika data ada, maka data di update
        # Jika data tidak berhasil, maka kembalikan pesan tidak ada

        if ($patients) {
            $patients->update($request->all());
            
            $data = [
                'message' => 'Resource is update successfully',
                'data' => $patients
            ];

            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return respone()->json($data, 404);

        }
    }

    function destroy($id)
    {
        $patients = Patient::find($id);

        # Cari id patient
        # Jika ketemu, maka hapus datanya

        if ($patients) {
            $patients->delete();

            $data = [
                'message' => 'Resource is delete successfully'
            ];

            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);

        }
    }

    function search($name)
    {
        $patients = Patient::where('name', 'like', '%'. $name. '%')->get();

        $semua = count($patients);

        if ($semua) {
            $data = [
                'message' => 'Get searched resource', 
                'semua' => $semua,
                'data' => $patients
            ];

            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);

        }
    }

    function searchByStatus($status)
    {
        $patients = Patient::where('status', $status)->get();

        $semua = count($patients);

        if ($semua) {
            $data = [
                'message' => 'Get status resource',
                'semua' => $semua,
                'data' => $patients
            ];

            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);

        }
    }

    function positive()
    {
        return $this->searchByStatus('positive');
    }

    function recovered()
    {
        return $this->searchByStatus('recovered');
    }

    function dead()
    {
        return $this->searchByStatus('dead');
    }

}