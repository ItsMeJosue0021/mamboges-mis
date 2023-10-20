<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\OrgChartRow;
use Illuminate\Http\Request;

class OrgChartRowController extends Controller
{
    public function create()
    {
        return view('org-chart.create', [
            'orgChartRows' => OrgChartRow::orderBy('order')->get(),
            'totalRows' => OrgChartRow::count()
        ]);
    }

    public function store(Request $request)
    {
        $totalRows = OrgChartRow::count();

        $orgChartRow = OrgChartRow::create([
            'order' => $totalRows + 1,
        ]);

        if ($orgChartRow) {
            return redirect()->back()->with('success', 'Created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request)
    {
        $orgChartRow = OrgChartRow::find($request->rowId);

        if (!$orgChartRow) {
            return redirect()->back()->with('success', 'Row not found.');
        }

        $orgChartRow->update([
            'title' => $request->title,
            'order' => $request->order
        ]);

        if ($orgChartRow) {
            return redirect()->back()->with('success', 'Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy(OrgChartRow $orgChartRow)
    {
        foreach ($orgChartRow->orgChartRowItems as $orgChartRowItem) {
            $orgChartRowItem->delete();
        }

        if ($orgChartRow->delete()) {
            return redirect()->route('org.chart.create')->with('success', 'Deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong while deleting row.');
        }
    }
}
