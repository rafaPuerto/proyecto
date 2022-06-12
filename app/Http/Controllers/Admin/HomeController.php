<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Clase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        if(Auth::user()->hasRole('Instructor'))
        {
            $myStudents = User::where('instructor_id', Auth::id())->get();

            return view('admin.home', compact('myStudents'));
        }
        if(Auth::user()->hasRole('Alumno'))
        {
            $user=User::where('id', Auth::id())->first();
            $clases=Clase::where('alumno_id', $user->id)->orderBy('hora_inicio', 'DESC')->get( );

            foreach($clases as $clase)
            {
                $clase->hora_inicio=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_inicio);
                if($clase->hora_final!=null){
                    $clase->hora_final=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_final);
                }
            }
            return view('admin.users.show', compact('user', 'clases'));
        }
        if(Auth::user()->hasRole('Administrativo')){
            $users=User::all();
            foreach($users as $user)
            {
                $user->hora_nacimiento=$user->convertToCarbon($user);
            }
            return view('admin.users.index', compact('users'));
        }
        if(Auth::user()->hasRole('Administrador'))
        {
            return view('admin.users.adminHome');
        }
    }
}
