<?php

namespace App\Http\Controllers\Admin\Trait;

use App\Models\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait FaqTrait
{

    public function faqList()
    {
         $this->authorizePermission('faq_view');
        $faq_items = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.faq.list',compact('faq_items'));
    }

    public function faqSave(Request $request)
    {
         $this->authorizePermission('faq_create');
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $data = [
            'question' => $request['question'],
            'answer' => $request['answer'],
            'email' => Auth::guard('admin')->user()->email,
        ];

        $frontend = !empty($request['faq_id'])  ? Frontend::find($request['faq_id']) : new Frontend();
        $frontend->data_keys = 'faq-section';
        $frontend->data_values = json_encode($data);
        $frontend->save();
        $faq_list = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['data'=> ['faq_items' => $faq_list->items(), 'pagination' => $faq_list->links()->render()],
            'success' => 'Faq saved successfully']);
    }

    public function faqDelete($id)
    {
         $this->authorizePermission('faq_delete');
        $faq = Frontend::find($id);
        $faq->delete();
        $faq_list = Frontend::where('data_keys','faq-section')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['data'=> ['faq_items' => $faq_list->items(), 'pagination' => $faq_list->links()->render()],
            'success' => 'Deleted FAQ successfully']);
    }

    public function search(Request $request)
    {
        $query = Frontend::where('data_keys','faq-section');
        if ($request->filled('question')) {
            $query->where(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(data_values, '$.question'))"), 'LIKE', '%' . $request['question'] . '%');
        }

        $faq_list = $query->paginate(5);
        return response()->json(['data'=> ['faq_items' => $faq_list->items(),'pagination' => $faq_list->links()->render()]]);

    }
}
