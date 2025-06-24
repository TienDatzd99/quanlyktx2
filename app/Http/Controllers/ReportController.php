<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back()->with('success', 'Xóa báo cáo thành công!');
    }
}