<?php

namespace App\Http\Controllers;

use App\Models\consultancy_branch;
use App\Models\consultancy_info;
use App\Models\PersonalAccessToken;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminUsersControllers extends Controller
{
    public function users()
    {
        $userData = User::with('allUsers', 'personalAccessTokens', 'consultancy')->orderBy('role', 'asc')->get();
        $data = compact('userData');
        return view('superadmin.allUsers')->with($data);
    }

    public function delete(Request $request)
    {
        $token = $request->id;
        $tokenFind = PersonalAccessToken::where('token', $token)->first();
        if ($tokenFind) {
            $user = $tokenFind->user()->with('personalAccessTokens')->first();
            if ($user->branch_id) {
                consultancy_branch::destroy($user->branch_id);
            }
            if ($user->consultancy_id) {
                consultancy_info::destroy($user->consultancy_id);
            }
            $tokenFind->delete();
            return redirect()->back()->with('success', 'Deleted successfully.');
        } else {
            return redirect()->back()->with('fail', 'Data is not deleted.');
        }
    }

    public function viewConsultancies()
    {
        $consultancies = User::where('role', '2')->with('consultancy', 'personalAccessTokens')->get()
            ->sortBy(function ($query) {
                $query->name;
            });
        return view('superadmin.viewConsultancies', compact('consultancies'));
    }
    public function viewBranch()
    {
        $viewBranch = user::where('role', '3')->with('consultancy', 'personalAccessTokens')->get()->sortBy(function ($query) {
            $query->consultancy_id;
        });
        return view('superadmin.viewBranch', compact('viewBranch'));
    }

    public function viewDetailsofUser(Request $request)
    {
        $title = 'Details of';
        $token = $request->id;
        $findToken = PersonalAccessToken::where('token', $token)->first();
        if ($findToken) {
            $findTokenUser = $findToken->user()->with('personalAccessTokens', 'allUsers', 'consultancy', 'userBranch')->first();
            return view('superadmin.viewDetailsofUser', compact('findTokenUser', 'title'));
        }
        return redirect()->back()->with('fail', 'User not found.');
    }
    public function update(Request $request)
    {
        $consultancyTitle = 'Consultancy Update Form';
        $branchTitle = 'Branch Udpate Form';
        $consultancyDatas = User::where('role', '2')->with('consultancy')->get();
        $token = $request->id;
        $findToken = PersonalAccessToken::where('token', $token)->first();
        if ($findToken) {
            $findTokenUser = $findToken->user()->with('personalAccessTokens', 'consultancy', 'userBranch')->first();
            return view('superadmin.updateDetails', compact('findTokenUser', 'consultancyTitle', 'branchTitle', 'consultancyDatas', 'token'));
        }
    }

    public function updateConsultancy(Request $request)
    {
        $token = $request->id;

        $request->validate([
            'consultancyName' => 'required',
            'headOfficeDistrict' => 'required',
            'headOfficeMunicipality' => 'required',
            'headOfficeWard' => 'required',
            'phone' => 'required|min:10|max:10',
            'tel_number' => 'required | max:10',
            'pan_number' => 'required| min:4',
            'head_person_name' => 'required',
            'head_person_number' => 'required|min:10|max:10',
        ]);
        $searchUser = PersonalAccessToken::where('token', $token)->first();
        if ($searchUser) {
            $foundUser = $searchUser->user()->with('personalAccessTokens', 'consultancy')->first();
            $foundUser->consultancy->telphone_num = $request->tel_number;
            $foundUser->consultancy->pan_number = $request->pan_number;
            $foundUser->consultancy->head_person_fullname = $request->head_person_name;
            $foundUser->consultancy->head_person_number = $request->head_person_number;
            $saved = $foundUser->consultancy->save();
            if ($saved) {
                $foundUser->name = $request->consultancyName;
                $foundUser->u_district = $request->headOfficeDistrict;
                $foundUser->u_municipality = $request->headOfficeMunicipality;
                $foundUser->u_ward = $request->headOfficeWard;
                $foundUser->phone = $request->phone;
                $foundUser->save();
                return redirect()->back()->with('success', 'Consultancy updated Successfully.');
            }
            return redirect()->back()->with('fail', 'Consultancy update failed.');

        }
        return redirect()->back()->with('fail', 'No user fouund.');
    }

    public function updateBranch(Request $request)
    {
        $request->validate([
            'consultancyName' => 'required',
            'branchName' => 'required',
            'branchPhone' => 'required|min:10|max:10',
            'branchDistrict' => 'required',
            'branchMunicipality' => 'required',
            'branchWard' => 'required',
            'branchPan' => 'required|min:4',
            'branchManager' => 'required',
            'branchManagerPhone' => 'required|min:10|max:10',
        ]);
        $token = $request->id;
        $finduser = personalAccessToken::where('token', $token)->first();
        if ($token) { {
                $user = $finduser->user()->with('personalAccessTokens', 'userBranch')->first();
                $user->userBranch->branch_pan = $request->branchPan;
                $user->userBranch->branch_manager_name = $request->branchManager;
                $user->userBranch->branch_manager_phone = $request->branchManagerPhone;
                $save = $user->userBranch->save();
            }
            if ($save) {
                $user->name = $request->branchName;
                $user->consultancy_id = $request->consultancyName;
                $user->phone = $request->branchPhone;
                $user->u_district = $request->branchDistrict;
                $user->u_municipality = $request->branchMunicipality;
                $user->u_ward = $request->branchWard;
                $user->save();
                return redirect()->back()->with('success', 'Branch is updated successfully.');
            }
            return redirect()->back()->with('fail', 'Branch is not updated.');

        }
        return redirect()->back()->with('fail', 'User not found.');
    }
}
