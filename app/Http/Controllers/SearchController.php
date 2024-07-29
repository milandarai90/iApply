<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultancy_info;
use App\Models\Consultancy_branch;
use App\Models\Country;
use App\Models\Course;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');

        if (!$query) {
            return response()->json([
                'error' => 'Write something to search.'
            ], 400);
        }

     
        // Search in User with role '2' (Consultancy)
        $consultancy = User::with('consultancy', 'userToProfileImage','userBranch')
            ->where('role', '2')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->get();
            if ($consultancy->isNotEmpty()) {
                $consultancyData = $consultancy->map(function ($user) {
                    $branches = consultancy_branch::where('consultancy_id', $user->consultancy_id)
                    ->with('userBranch.userToProfileImage')
                    ->get()
                    ->map(function ($branch) {
                        return [
                            'id' => $branch->userBranch->id,
                            'name' => $branch->userBranch->name,
                            'email' => $branch->userBranch->email,
                            'phone_number' => $branch->userBranch->phone,
                            'photo' => $branch->userBranch->userToProfileImage ? url('storage/' . $userBranch->userToProfileImage->image_path) : null,
                            'district' => $branch->userBranch->u_district,
                            'municipality' => $branch->userBranch->u_municipality,
                            'ward' => $branch->userBranch->u_ward,
                        ];
                    });
    
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_number' => $user->phone,
                        'photo' => $user->userToProfileImage ? url('storage/' . $user->userToProfileImage->image_path) : null,
                        'district' => $user->u_district,
                        'municipality' => $user->u_municipality,
                        'ward' => $user->u_ward,
                        'branch_details' => $branches,
                    ];
                });
    
                return response()->json(['consultancy' => $consultancyData]);
            }
    
    
        // Search in User with role '3' (Branch)
        $branch = User::with('userBranch')
            ->where('role', '3')
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->get();

        if ($branch->isNotEmpty()) {
            return response()->json(['branch' => $branch]);
        }

        // Search in Country
        $country = Country::with('country_to_consultancy', 'country_to_guidelines')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();

        if ($country->isNotEmpty()) {
            return response()->json(['country' => $country]);
        }

        // Search in Course
        $course = Course::with('branchCourse', 'course')
            ->where('course', 'LIKE', "%{$query}%")
            ->get();

        if ($course->isNotEmpty()) {
            return response()->json(['course' => $course]);
        }

        // If no results found
        return response()->json(['message' => 'No Data Found.']);
    }
}
