<?php

namespace App\Http\Controllers\Super;

use App\CanvasUser;
use App\Http\Controllers\Controller;
use App\Http\Middleware\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('user_management')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('profile')->with(["user" => $user,"title"=>"User Profile"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $indonesia = file_get_contents(base_path('resources/js/indonesia.json'));
        $indonesia = \GuzzleHttp\json_decode($indonesia,true);
        $user = User::find($id);
        return view('edit_user')->with(["user" => $user, "indonesia" => $indonesia]);
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
            return redirect(route('super.user-management.show',["user_management" => $id]))->with('message','Success Update Your Profile');
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

    public function updateRole(Request $request, $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'role' => ['required', 'integer'],
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        try {
            $user = User::findOrFail($id);
            $user->retract($user->roles[0]->name);
            $user->assign($request->get('role') == 2? 'admin':'user' );
            if ($request->get('role') == 2){
                $admin = \Canvas\Models\User::where('id',$user->id)->get();
                if (sizeof($admin) == 0){
                    $newUser = \Canvas\Models\User::create([
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email,
                        "username" => explode(" ",$user->name)[0],
                        "password" => $user->password
                    ]);
                }
            }

            toastSuccess("Role Has Been Changed");
            return redirect()->back();
        }catch (Exception $exception){
            return redirect()->back()->withErrors("Error, Something went wrong");
        }
    }
}
