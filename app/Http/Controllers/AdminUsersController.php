<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        Session::flash('created_user', 'the user has been created');

        if(trim($request->password) == ""){

            $input = $request->except('password');

        }else {

            $input = $request->all();
            
            $input['password']= bcrypt($request->password);
        }




        if($file = $request->file('photo_id')){

             $name = time() .$file->getClientOriginalName();


             $file->move('images',$name);
             $photo = Photo::create(['file'=>$name]);
             $input['photo_id']=$photo->id;
        }



        User::create($input);



//        User::create($request->all());


        return redirect('/admin/users');

//        return $user = $request->all();




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
        return view('admin.users.show');
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



        $user = User::findOrFail($id);

        $roles = Role::pluck('name','id')->all();


        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //

        Session::flash('updated_user', 'the user has been edited');
//        $input = $request->all();

        if(trim($request->password) == ""){

            $input = $request->except('password');

        }else {

            $input = $request->all();

            $input['password']= bcrypt($request->password);
        }


        $user = User::findOrFail($id);

        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }
        $user->update($input);
        return redirect('/admin/users');
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

      $user = User::findOrFail($id);

//       $request->session();
//       session()




        $name = $user->photo->file;

        unlink(public_path(). $name);

        $user->delete();

        Session::flash('deleted_user', 'the user has been deleted');

       return redirect('admin/users');



//        return view('admin.users.destroy');
    }
}
