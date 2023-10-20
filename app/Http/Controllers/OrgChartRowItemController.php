<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgChartRowItem;

class OrgChartRowItemController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'position' => 'required',
        ]);

        $orgChartRowItem = [
            'name' => $validatedData['name'],
            'position' => $validatedData['position'],
            'org_chart_row_id' => $request->rowId,
        ];

        if ($request->hasFile('image')) {
            $orgChartRowItem['image'] = $request->file('image')->store('chart', 'public');
        }

        $saved = OrgChartRowItem::create($orgChartRowItem);

        if ($saved) {
            return redirect()->back()->with('success', 'Item added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

    public function update(Request $request)
    {
        $orgChartRowItem = OrgChartRowItem::findOrFail($request->itemId);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chart', 'public');
        }

        $orgChartRowItem->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path
        ]);

        if ($orgChartRowItem) {
            return redirect()->back()->with('success', 'Item updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy($orgChartRowItemId)
    {
        $orgChartRowItem = OrgChartRowItem::findOrFail($orgChartRowItemId);

        if ($orgChartRowItem->delete()) {
            return redirect()->back()->with('success', 'Item deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong while deleting the item.');
        }
    }

}
