<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use Illuminate\Http\Request;

class UpdateImageController extends Controller
{
    public function destroy($updateId, $updateIamgeId)
    {

        $update = Updates::find($updateId);
        $image = $update->updateImages()->where('id', $updateIamgeId)->first();

        if (!$image) {
            return response()->json([
                'message' => 'Image not found!',
                'status' => 'error'
            ]);
        }

        $imageDeleted = $image->delete();

        if ($imageDeleted) {
            return response()->json([
                'message' => 'Image deleted successfully!',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'Cannot delete image!',
                'status' => 'error'
            ]);
        }

    }
}