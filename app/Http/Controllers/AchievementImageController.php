<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementImageController extends Controller
{
    public function destroy($achievementId, $achievementIamgeId)
    {

        $achievement = Achievement::find($achievementId);
        $image = $achievement->achievementImages()->where('id', $achievementIamgeId)->first();

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