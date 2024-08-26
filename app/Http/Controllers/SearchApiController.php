<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultancy_info;
use App\Models\Consultancy_branch;
use App\Models\Country;
use App\Models\Country_guidelines;
use App\Models\Classroom;
use App\Models\Course;

class SearchApiController extends Controller
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
                    ->map(function ($branch) use ($user) {
                        $courses = Course::where('consultancy_id', $user->consultancy_id)
                            ->where('branch_id', $branch->id)
                            ->get()
                            ->map(function($course) use ($branch) {

                                $classCount = Classroom::where('branch_id',$branch->id)
                                ->where('course_id',$course->id)
                                ->count();

                                $classes = Classroom::where('branch_id',$branch->id)
                                ->where('course_id',$course->id)
                                ->get()
                                ->map(function($class) use ($classCount) {
                                    return[
                                        'id'=>$class->id,
                                        'class_name'=>$class->class_name,
                                        'students_number' =>$classCount,
                                        'seat_numbers'=>$class->seats_number,
                                        'status'=>$class->status,
                                        'start_time'=>$class->starting_time,
                                        'end_time'=>$class->ending_time,
                                        'start_date'=>$class->starting_date,
                                        'end_date'=>$class->ending_date,
                                    ];
                                });
                                return [
                                    'id' => $course->id,
                                    'course_title'=>$course->course,
                                    'class_details' => $classes->isNotEmpty() ? $classes : null
                                ];
                            });
                        return [
                            'id' => $branch->userBranch->id,
                            'name' => $branch->userBranch->name,
                            'email' => $branch->userBranch->email,
                            'phone_number' => $branch->userBranch->phone,
                            'photo' => $branch->userBranch->userToProfileImage ? url('storage/' . $userBranch->userToProfileImage->image_path) : null,
                            'district' => $branch->userBranch->u_district,
                            'municipality' => $branch->userBranch->u_municipality,
                            'ward' => $branch->userBranch->u_ward,
                            'course_details' => $courses->isNotEmpty() ? $courses :null,
                        ];
                    });
                    
                    $country = country::where('consultancy_id',$user->consultancy_id)
                    ->with('country_to_guidelines')
                    ->get()
                    ->map(function($countryData){

                        $guidelines = country_guidelines::where('consultancy_id',$countryData->consultancy_id)
                        ->where('country_id',$countryData->id)
                        ->get()
                        ->map(function ($guide) use ($countryData){

                            return[
                               'process'=>$guide->guidelines
                            ];
                        });

                        return[
                            'id'=>$countryData->id,
                            'country'=>$countryData->name,
                            'map'=>$countryData->country_map ? url('storage/'. $countryData->country_map) : null,
                            'guidelines'=> $guidelines->isNotEmpty() ?$guidelines:null,
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
                        'branch_details' => $branches->isNotEmpty() ? $branches :null,
                        'country_details'=>$country->isNotEmpty() ? $country :null,
                    ];
                });
    
                return response()->json(['consultancy_details' => $consultancyData]);
            }
    
    
        // Search in User with role '3' (Branch)

         $branch = User::with('consultancy', 'userToProfileImage', 'userBranch')
         ->where('role', '3')
         ->where(function ($q) use ($query) {
             $q->where('name', 'LIKE', "%{$query}%")
               ->orWhere('email', 'LIKE', "%{$query}%");
         })
         ->get();

         if ($branch->isNotEmpty()) {
            $branchData = $branch->map(function ($item) {
                $courses = Course::where('consultancy_id', $item->consultancy_id)
                    ->where('branch_id', $item->branch_id)
                    ->with('course')
                    ->get()
                    ->map(function ($course) use ($item) {
                        $classes = Classroom::where('course_id', $course->id)
                            ->where('branch_id', $item->branch_id)
                            ->with('course')
                            ->get();
        
                        $classCounts = $classes->count();
        
                        $classDetails = $classes->map(function ($classData) use ($classCounts, $item) {
        
                            return [
                                'id' => $classData->id,
                                'class_name' => $classData->class_name,
                                'students_number' => $classCounts,
                                'seat_numbers' => $classData->seats_number,
                                'status' => $classData->status,
                                'start_time' => $classData->starting_time,
                                'end_time' => $classData->ending_time,
                                'start_date' => $classData->starting_date,
                                'end_date' => $classData->ending_date,
                            ];
                        });
        
                        return [
                            'id' => $course->id,
                            'course_title' => $course->course,
                            'class_details' => $classDetails->isNotEmpty() ? $classDetails : null,
                        ];
                    });
        
                $consultancies = consultancy_info::where('id', $item->consultancy_id)
                    ->with('consultancyDetails')
                    ->get()
                    ->map(function ($consultancy) use ($item){

                        $country = country::where('consultancy_id',$item->consultancy_id)
                        ->with('country_to_guidelines')
                        ->get()
                        ->map(function($countryData){
    
                            $guidelines = country_guidelines::where('consultancy_id',$countryData->consultancy_id)
                            ->where('country_id',$countryData->id)
                            ->get()
                            ->map(function ($guide) use ($countryData){
    
                                return[
                                   'process'=>$guide->guidelines
                                ];
                            });
    
                            return[
                                'country'=>$countryData->name,
                                'map'=>$countryData->country_map ? url('storage/'. $countryData->country_map) : null,
                                'guidelines'=> $guidelines->isNotEmpty() ?$guidelines:null,
                            ];
                        });

                        return [
                            'id' => $consultancy->consultancyDetails->id,
                            'name' => $consultancy->consultancyDetails->name,
                            'phone_number'=>$consultancy->consultancyDetails->phone,
                            'email'=>$consultancy->consultancyDetails->email,
                            'photo' => $consultancy->consultancyDetails->userToProfileImage ? url('storage/' . $consultancy->consultancyDetails->userToProfileImage->image_path) : null,
                            'district' => $consultancy->consultancyDetails->u_district,
                            'municipality' => $consultancy->consultancyDetails->u_municipality,
                            'ward' => $consultancy->consultancyDetails->u_ward,
                            'country_details'=>$country->isNotEmpty() ? $country :null,


                        ];
                    });
        
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone_number' => $item->phone,
                    'photo' => $item->userToProfileImage ? url('storage/' . $item->userToProfileImage->image_path) : null,
                    'district' => $item->u_district,
                    'municipality' => $item->u_municipality,
                    'ward' => $item->u_ward,
                    'course_details' => $courses->isNotEmpty() ? $courses : null,
                    'consultancy_details' => $consultancies->isNotEmpty() ? $consultancies : null,
                ];
            });
        
            return response()->json(['branch' => $branchData]);
        }
        
            
        // Search in Country
        // $country = Country::with('country_to_consultancy', 'country_to_guidelines')
        //     ->where('name', 'LIKE', "%{$query}%")
        //     ->get();

        // if ($country->isNotEmpty()) {
        //     return response()->json(['country' => $country]);
        // }

        // Search in Course
        $courses = Course::with('branchCourse', 'course')
            ->where('course', 'LIKE', "%{$query}%")
            ->get();

            if ($courses->isNotEmpty()) {
                $courseData = $courses->map(function ($courseDetails) {
        
                    $classes = Classroom::where('course_id', $courseDetails->id)
                        ->where('branch_id', $courseDetails->branch_id)
                        ->with('course')
                        ->get();
        
                    $classCounts = $classes->count();
        
                    // Corrected use statement to remove $courseDetails, as it is not used in the closure
                    $classDetails = $classes->map(function ($classData) use ($classCounts) {
                        return [
                            'id' => $classData->id,
                            'class_name' => $classData->class_name,
                            'students_number' => $classCounts,
                            'seat_numbers' => $classData->seats_number,
                            'status' => $classData->status,
                            'start_time' => $classData->starting_time,
                            'end_time' => $classData->ending_time,
                            'start_date' => $classData->starting_date,
                            'end_date' => $classData->ending_date,
                        ];
                    });
        
                    $branchData = Consultancy_branch::where('id', $courseDetails->branch_id)
                        ->with('branch', 'userBranch')
                        ->get()
                        ->map(function ($branchDetails) {
                            return [
                                'id' => $branchDetails->userBranch->id,
                                'name' => $branchDetails->userBranch->name,
                                'email' => $branchDetails->userBranch->email,
                                'phone_number' => $branchDetails->userBranch->phone,
                                'photo' => $branchDetails->userBranch->userToProfileImage ? url('storage/' . $branchDetails->userBranch->userToProfileImage->image_path) : null,
                                'district' => $branchDetails->userBranch->u_district,
                                'municipality' => $branchDetails->userBranch->u_municipality,
                                'ward' => $branchDetails->userBranch->u_ward,
                            ];
                        });
        
                    // Changed from $branchDetails to correct scope of $courseDetails
                        

                    $consultancyData = Consultancy_info::where('id', $courseDetails->consultancy_id)
                        ->with('consultancyDetails')
                        ->get()
                        ->map(function ($consultancy) {

                            $country = country::where('consultancy_id',$consultancy->id)
                            ->with('country_to_guidelines')
                            ->get()
                            ->map(function($countryData){
        
                                $guidelines = country_guidelines::where('consultancy_id',$countryData->consultancy_id)
                                ->where('country_id',$countryData->id)
                                ->get()
                                ->map(function ($guide) use ($countryData){
        
                                    return[
                                       'process'=>$guide->guidelines
                                    ];
                                });
        
                                return[
                                    'country'=>$countryData->name,
                                    'map'=>$countryData->country_map ? url('storage/'. $countryData->country_map) : null,
                                    'guidelines'=> $guidelines->isNotEmpty() ?$guidelines:null,
                                ];
                            });

                            return [
                                'id' => $consultancy->consultancyDetails->id,
                                'name' => $consultancy->consultancyDetails->name,
                                'phone_number' => $consultancy->consultancyDetails->phone,
                                'email' => $consultancy->consultancyDetails->email,
                                'photo' => $consultancy->consultancyDetails->userToProfileImage ? url('storage/' . $consultancy->consultancyDetails->userToProfileImage->image_path) : null,
                                'district' => $consultancy->consultancyDetails->u_district,
                                'municipality' => $consultancy->consultancyDetails->u_municipality,
                                'ward' => $consultancy->consultancyDetails->u_ward,
                                'country_details'=>$country->isNotEmpty() ? $country :null,

                            ];
                        });
        
                    return [
                        'id' => $courseDetails->id,
                        'course_title' => $courseDetails->course,
                        'class_details' => $classDetails->isNotEmpty() ? $classDetails : null,
                        'branch_details' => $branchData->isNotEmpty() ? $branchData : null,
                        'consultancy_details' => $consultancyData->isNotEmpty() ? $consultancyData : null,
                    ];
                });
        
                return response()->json(['course' => $courseData]);
            }
        
            // If no results found
            return response()->json(['message' => 'No Data Found.']);
        }
}
