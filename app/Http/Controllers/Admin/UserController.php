<?php

namespace App\Http\Controllers\Admin;

use App\Exports\User as ExportsUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller {
    public function list() {
        $user = User::with('userDoc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.list', compact('user'));
    }

    public function search(Request $request) {
        $query = User::query();
        if (!empty($request['name_search'])) {
            $query->where('name', 'like', '%' . $request['name_search'] . '%');
        }
        $user_list = $query->paginate(10);
        return response()->json(['data' => ['user' => $user_list->items(), 'pagination' => $user_list->links()->render()]]);
    }






    /**
     * Export data for History
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function users_export(Request $request) {
        $ext = $request->query('v');
        $dataset = $this->getData();

        if ($ext == 'csv') {
            return Excel::download(new ExportsUser(type: $ext, dataset: $dataset), 'user-export.csv');
        }

        $pdf = Pdf::loadView('admin.user.pdf', ["user" => $dataset]);
        return $pdf->download('user-export.pdf');
    }





    /**
     * Get Data for History
     * @param string $type
     */
    protected function getData() {

        return User::with('userDoc')->orderBy('created_at', 'desc')->get([
            'name',
            'mobile',
            'email',
            'aadhaar_number',
            'driving_licence',
            'updated_at'
        ]);
    }
}
