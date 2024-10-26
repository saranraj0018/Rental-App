<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\CarBlock;
use App\Models\CarDetails;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarBlockController extends BaseController
{
    public function list(Request $request)
    {
//        $this->authorizePermission('car_bk_tab');
        $car_block = CarBlock::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $car_models = CarModel::all(['car_model_id','model_name']);
        $car_details = CarDetails::where('status',1)->pluck('register_number');
        $permissions = getAdminPermissions();
        return view('admin.cars.blocks.list',compact('car_block','car_models','car_details','permissions'));
    }

    public function save(Request $request)
    {
        $this->authorizePermission('car_av_add');
        $blockType = $request['block_type'];
        $request->validate([
            'block_type' => 'required|in:0,1,2,3,4,5',
            'hub' => 'required',
            'car_model' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'booking_id' => $blockType == '0' ? 'required|string' : 'nullable',
            'comment' => $blockType != '1' ? 'required|string' : 'nullable',
            'block_car_register_number' => 'required|not_in:Car Register Number',
            'reason' => 'required_if:block_type,0',
            'reason_discretion' => 'required_if:block_type,1',

        ]);
        $car_block = new CarBlock();
        $car_block->block_type = $request['block_type'];
        $car_block->hub = $request['hub'];
        $car_block->car_model = $request['car_model'];
        $car_block->booking_id = $request['booking_id'];
        $car_block->car_register_number = $request['block_car_register_number'];
        $car_block->start_date = $request['start_date'];
        $car_block->end_date = $request['end_date'];
        $car_block->comment = $request['block_type'] != 1 ? $request['comment'] : null;
        $car_block->reason =  $request['block_type'] == 0 || $request['block_type'] == 1 ?
            !empty($request['reason']) ? $request['reason'] : $request['reason_discretion'] : null;
        $car_block->user_id = Auth::guard('admin')->id();
        $car_block->save();

        $car_status = CarDetails::where('register_number', $request['block_car_register_number'])->first();
        $car_status->status = 2;
        $car_status->save();

        $car_block_list = CarBlock::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $car_block_list,'success' => 'Car blocked saved successfully']);
    }

    public function update(Request $request)
    {
        $this->authorizePermission('car_av_edit');
        $request->validate([
            'edit_start_date' => 'required|date',
            'edit_end_date' => 'required|date|after:start_date',
            'edit_comment' => 'required|string',
        ]);
        $car_block = CarBlock::find($request['block_id']);
        $car_block->start_date = $request['edit_start_date'];
        $car_block->end_date = $request['edit_end_date'];
        $car_block->comment = $request['edit_comment'];
        $car_block->user_id = Auth::guard('admin')->id();
        $car_block->save();
        $car_block_list = CarBlock::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['data'=> $car_block_list,'success' => 'Car blocked Update successfully']);
    }

    public function search(Request $request)
    {
        $query = CarBlock::with('user');
        if ($request->filled('block_type')) {
            $query->where('block_type', $request['block_type']);
        }

        if ($request->filled('register_number')) {
            $query->where('car_register_number', 'like', '%' .  $request['register_number']. '%');
        }

        $car_block = $query->get();

        return response()->json([
            'data' => $car_block,
        ]);
    }
}
