<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Image;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showMyProfile(){
        $user_info = User::where('id',Auth::user()->id)->first();
        return view('backend.profile',compact('user_info'));
    }

    public function saveProfile(Request $request){

        $user_info = User::where('id',Auth::user()->id)->first();

        $profile_image = null;
        if ($request->hasFile('image')){

            if($user_info->image != null){
                if(file_exists($user_info->image)){
                    unlink($user_info->image);
                    // unlink('public/'.$user_info->image);
                }
            }

            $get_image = $request->file('image');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            Image::make($get_image)->save('profile_images/' . $image_name, 50);
            // Image::make($get_image)->save('public/profile_images/' . $image_name, 50);
            $profile_image = "profile_images/" . $image_name;

            User::where('id',Auth::user()->id)->update([
                'image' => $profile_image
            ]);
        }

        if($request->password != ''){
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'company_name' => $request->company_name,
            'updated_at' => Carbon::now()
        ]);

        Toastr::success('Profile Updated Successfully', 'Success');
        return redirect()->back();

    }
}
