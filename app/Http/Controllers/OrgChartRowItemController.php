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

    public function update(Request $request, $orgChartRowItemId)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $orgChartRowItem = OrgChartRowItem::findOrFail($orgChartRowItemId);

        $orgChartRowItem->name = $validatedData['name'];
        $orgChartRowItem->position = $validatedData['position'];

        if ($request->hasFile('image')) {
            $orgChartRowItem->image = $request->file('image')->store('chart', 'public');
        }

        if ($orgChartRowItem->save()) {
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
