<?php

namespace App\Http\Controllers\Admin;

use App\Exports\User as ExportsUser;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends BaseController {
    public function list() {
        $this->authorizePermission('user_view');

        $user = User::with('userDoc')->orderBy('created_at', 'desc')->paginate(10);
        $permissions = getAdminPermissions();
        return view('admin.user.list', compact('user', 'permissions'));
    }

    public function search(Request $request)
    {
        $query = User::query();
        if (!empty($request['name_search'])) {
            $query->where('name', 'like', '%' .  $request['name_search']. '%');
        }
        $user_list = $query->paginate(10);
        return response()->json(['data'=> ['user' => $user_list->items(),'pagination' => $user_list->links()->render()]]);

    }

    /**
     * Export data for History
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function users_export(Request $request) {
          $this->authorizePermission('user_export');
        $ext = $request->query('v');
        $dataset = $this->getData();

        if ($ext == 'csv') {
            return Excel::download(new ExportsUser(type: $ext, dataset: $dataset), 'user-export.csv');
        }

        $pdf = Pdf::loadView('admin.user.pdf', ["user" => $dataset]);
        return $pdf->download('user-export.pdf');
    }


    public function updatePassword(Request $request): JsonResponse
    {
        try{

            $user = \App\Models\AdminDetail::find($request->userId);

            if(!$user)
                throw new ModelNotFoundException('User Does not exists', code: 404);

            $_password = Hash::make($request->password);


            $user->update([
                'password' => $_password
            ]);

            return response()->json([
                'status' => 201,
                'message' => 'Password Updated Successfully'
            ], 201);
        } catch(\Throwable $th) {

            return response()->json([
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ]);
        }
    }





    public function deleteUser(Request $request) : JsonResponse
    {
        try{
            $user = \App\Models\AdminDetail::find($request->userId);

            if(!$user)
                throw new ModelNotFoundException('User Does not exists', code: 404);

            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User Deleted Successfully'
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ]);
        }
    }



    /**
     * Get Data for History
     * @param string $type
     */
    protected function getData() {
   $this->authorizePermission('user_export');
        return User::with('userDoc')->orderBy('created_at', 'desc')->get([
            'name',
            'mobile',
            'email',
            'aadhaar_number',
            'driving_licence',
            'updated_at'
        ]);
    }



    public function saveComments(Request $request) {

        $request->validate([
            'userId' => 'required|integer',
            'comments' => 'required|string|max:255'
        ]);

        try{
            $user = User::find($request->userId);

            if(!$user)
                throw new ModelNotFoundException('User Does not exists', code: 404);

            $user->comments = $request->comments;
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Comments saved successfully',
                'comments' => $request->comments
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'status' => $th->getCode(),
                'message' => $th->getMessage()
            ]);
        }
    }
}
