<?php

namespace App\Http\Controllers;

use App\Models\OrgChartRow;
use Illuminate\Http\Request;

class OrgChartRowController extends Controller
{
    public function create()
    {
        return view('org-chart.create', [
            'orgChartRows' => OrgChartRow::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable',
        ]);

        $orgChartRow = OrgChartRow::create($validatedData);

        if ($orgChartRow) {
            return redirect()->back()->with('success', 'Created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, OrgChartRow $orgChartRow)
    {
        $validatedData = $request->validate([
            'title' => 'nullable',
        ]);

        $orgChartRow->update($validatedData);

        if ($orgChartRow) {
            return redirect()->route('org-chart-row.index')->with('success', 'Updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy(OrgChartRow $orgChartRow)
    {
        if ($orgChartRow->delete()) {
            return redirect()->route('org-chart-row.index')->with('success', 'Deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong while deleting row.');
        }
    }
}