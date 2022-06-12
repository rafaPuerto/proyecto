<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use App\Falta;
use App\Clase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::all();
        foreach($users as $user)
        {
            $user->fecha_nacimiento=$user->convertToCarbon($user);
        }

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {

        $instructores = $this->getInstructores();
        
        $roles = Role::all();

        return view('admin.users.create', compact('roles', 'instructores'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->cadena_unica = $user->generateCadenaUnica(); 
        
        $user->roles()->attach($request->input('roles_id'));
        $user->update();

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        $instructores = $this->getInstructores();

        return view('admin.users.edit', compact('roles', 'user', 'instructores'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        $clases=Clase::where('alumno_id',$user->id)->orderBy('hora_inicio', 'DESC')->get();
        foreach ($clases as $clase) {
            $clase->hora_inicio=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_inicio);
            if($clase->hora_final!=null){
                $clase->hora_final=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_final);
            }
        }

        return view('admin.users.show', compact('clases', 'user'));
    }

    public function destroy(User $user)
    {

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function myStudents()
    {
        return User::where('instructor_id', Auth::id())->get();
    }

    public function getInstructores()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('title', 'Instructor');
        })->get();
    }
}
