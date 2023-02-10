<?php

namespace App\Http\Controllers\User;

use Image;
use Validator;
use App\Models\Game;
use App\Models\User;
use App\Models\Deposit;
use App\Models\GameLog;
use App\Models\Service;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Models\ApplyService;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\ServiceCategory;
use App\Lib\GoogleAuthenticator;

use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = auth()->user();
        $data['user'] = Auth::user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user','data'));
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50'
            
        ],[
            'firstname.required'=>'First Name Field is required',
            'lastname.required'=>'Last Name Field is required'
        ]);


        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;


        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = rand(10000000,40000000) . '_' . $user->username.'.png';
            $location = 'assets/images/user/profile/'.$filename;
            $in['image'] = $filename;

            $path = './assets/images/user/profile/';
            $link = $path . $user->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            $size = imagePath()['profile']['user']['size'];
            $image = Image::make($image);
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[0]);
            $image->save($location);
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile Updated successfully.'];
        return back()->withNotify($notify);
    }

    // public function submitProfile(Request $request)
    // {
    //     $request->validate([
    //         'firstname' => 'required|string',
    //         'lastname' => 'required|string',
    //     ],[
    //         'firstname.required'=>'First name field is required',
    //         'lastname.required'=>'Last name field is required'
    //     ]);

    //     $user = Auth::user();

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $filename = rand(10000000,40000000) . '_' . $user->username.'.png';
    //         $location = 'assets/images/user/profile/'.$filename;
    //         $in['image'] = $filename;

    //         $path = './assets/images/user/profile/';
    //         $link = $path . $user->image;
    //         if (file_exists($link)) {
    //             @unlink($link);
    //         }
    //         $size = imagePath()['profile']['user']['size'];
    //         $image = Image::make($image);
    //         $size = explode('x', strtolower($size));
    //         $image->resize($size[0], $size[0]);
    //         $image->save($location);
    //     }
    //     $user->fill($in)->save();

    //     $user->firstname = $request->firstname;
    //     $user->lastname = $request->lastname;

    //     $user->address = [
    //         'address' => $request->address,
    //         'state' => $request->state,
    //         'zip' => $request->zip,
    //         'country' => @$user->address->country,
    //         'city' => $request->city,
    //     ];

    //     $user->save();
    //     $notify[] = ['success', 'Profile updated successfully'];
    //     return back()->withNotify($notify);
    // }

    public function Address()
    {
        $pageTitle = "Address Setting";
        $user = auth()->user();
        $data['user'] = Auth::user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user','data'));
    }

    public function submitAddress(Request $request)
    {
        $request->validate([
            'address' => "sometimes|required|max:80",
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|max:40',
            'city' => 'sometimes|required|max:50',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
        ];

        $user = Auth::user();

        
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile Updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        $user = Auth::user();
        return view($this->activeTemplate . 'user.password', compact('pageTitle','user'));
    }

    public function submitPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        $general = gs();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }

    public function analytics()
    {
        $pageTitle = "Analytics";
        $data['user'] = Auth::user();
        $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());

        $user = Auth::user();

        $user = Auth::user();

        $games                     = Game::active()->get();
        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $widget['total_invest'] = GameLog::where('user_id', $user->id)->sum('invest');
        $widget['total_win']    = GameLog::win()->where('user_id', $user->id)->sum('invest');
        $widget['total_loss']   = GameLog::loss()->where('user_id', $user->id)->sum('invest');

        $widget['match_count']  = GameLog::where('user_id', $user->id)->count();
        $widget['win_count']    = GameLog::win()->where('user_id', $user->id)->count();
        $widget['loss_count']   = GameLog::loss()->where('user_id', $user->id)->count();

        if($widget['total_win']>0){
            $widget['win_raito']    = (($widget['win_count'] / $widget['match_count']) * 100);
            $widget['loss_raito']   = 100 - $widget['win_raito'];
        }

        $game_logs      = GameLog::where('user_id', auth()->id())->where('status', 1)->latest()->with('game')->paginate(getPaginate());



        return view($this->activeTemplate. 'user.analytics', $data, compact('user', 'games', 'widget', 'pageTitle','game_logs'));
    }

    public function display_profile()
    {   
        $pageTitle = "Profile Setting";
        $data['user'] = Auth::user();

        $user = Auth::user();

        $games                     = Game::active()->get();
        $user                      = auth()->user();
        $widget['total_balance']   = $user->balance;
        $widget['total_deposit']   = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_withdrawn'] = Withdrawal::approved()->where('user_id', $user->id)->sum('amount');

        $widget['total_invest'] = GameLog::where('user_id', $user->id)->sum('invest');
        $widget['total_win']    = GameLog::win()->where('user_id', $user->id)->sum('invest');
        $widget['total_loss']   = GameLog::loss()->where('user_id', $user->id)->sum('invest');

        $widget['match_count']  = GameLog::where('user_id', $user->id)->count();
        $widget['win_count']    = GameLog::win()->where('user_id', $user->id)->count();
        $widget['loss_count']   = GameLog::loss()->where('user_id', $user->id)->count();
        
        if($widget['total_win']>0){
            $widget['win_raito']    = ($widget['win_count'] / $widget['match_count']) * 100;
            $widget['loss_raito']   = 100 - $widget['win_raito'];
        }
        


        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate. 'user.display_profile', $data, compact('pageTitle','user', 'games', 'widget','remarks','transactions'));
    }






}
