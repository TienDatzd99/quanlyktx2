<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Xóa đồ dùng thành công!');
    }
    public function report(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'description' => 'required|string',
        ]);

        $item = Item::find($request->item_id);
        $item->update([
            'status' => 'inactive', // Hoặc 'broken' tùy ý
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Báo cáo thành công, trạng thái đã cập nhật!'], 200);
    }
}