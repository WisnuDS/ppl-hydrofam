<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $indonesia = file_get_contents(base_path('resources/js/indonesia.json'));
        $indonesia = \GuzzleHttp\json_decode($indonesia,true);
        return view('edit_profile', compact('indonesia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'gender' => ['required', 'integer', 'digits:1'],
            'birth_date' => ['required','date'],
            'province' => ['required','string'],
            'city' => ['required','string'],
            'sub_district' => ['required','string'],
            'postal_code' => ['required','numeric'],
            'detail' => ['required','string'],
            'avatar' => 'image|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }
        try {

            $user = User::find($id);
            if ($request->hasFile('avatar')){
                $avatar =  $request->file('avatar');
                $avatar_path = 'ava'.$user->id.uniqid().'.'.$avatar->getClientOriginalExtension();
                if (\auth()->user()->avatar != null){
                    Storage::delete('public/'.\auth()->user()->avatar);
                }
                $avatar->storeAs('public/avatars',$avatar_path);
                $user->avatar = 'avatars/'.$avatar_path;
            }
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone_number = $request->get('phone_number');
            $user->gender = $request->get('gender');
            $user->birth_date = $request->get('birth_date');
            $user->province = $request->get('province');
            $user->city = $request->get('city');
            $user->sub_district = $request->get('sub_district');
            $user->postal_code = $request->get('postal_code');
            $user->detail = $request->get('detail');
            $user->save();
            toastSuccess("Success update your data");
            return redirect(route('user.profile.index'))->with('message','Success Update Your Profile');
        }catch (\Exception $exception){
            toastError('Something went Wrong');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
