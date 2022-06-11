<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Clase;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Falta;
use App\Grupo;
use App\Subgrupo;

class ClasesController extends Controller
{
    public function index()
    {
        //EJEMPLO ABORT_IF POR ROL
        //abort_if(Auth::$user->hasRole('admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clase = Clase::all();

        return view('admin.clases.index', compact('clase'));
    }

    public function create(Request $request)
    {
        $user=User::where('id',$request->user)->first();
        if($request->verificacion==$user->cadena_unica)
        {
            $clase = new Clase();
            
            $clase->instructor_id = Auth::id();
            $clase->alumno_id = $request->user;
            $clase->hora_inicio = Carbon::now()->format('Y-m-d H:i:s');
            $clase->save();
            return view('admin.clases.create', compact('clase'));
        }
        else
        {
            return back()->with('toast_error', 'Código de alumno equivocado');
        }
        
    }

    public function store(Request $request)
    {
        $clase = new Clase($request->all());
        
        $clase->hora_final=Carbon::now()->format('Y-m-d H:i:s');
        $clase->save();
        
        //return redirect()->route('admin.clase.index');
    }

    public function edit(Clase $clase)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $faltas = Falta::all();
        $grupos = Grupo::All();
        $subGrupos = Subgrupo::All();

        return view('admin.clases.edit', compact('clase', 'faltas'));
    }

    public function update(Request $request, Clase $clase)
    {
        $clase = Clase::findOrFail($clase->id);
        if(isset($request->recorrido)) 
        {
            $clase->recorrido=$request->recorrido;

            $clase->faltas()->sync($request->input('faltas', []));
            
            $clase->save();
            
            $user=User::where('id',$clase->alumno_id)->first();

            return redirect()->route('admin.users.show', $user->id);
        }else{
            $clase->hora_final=Carbon::now()->format('Y-m-d H:i:s');
            $clase->comentarios=$request->comentarios;
            $clase->save();

            $faltas = Falta::all();
            $grupos = Grupo::All();
            $subGrupos = Subgrupo::All();

            return view('admin.clases.edit', compact('clase','faltas', 'grupos', 'subGrupos'));

        }

    }
    
    public function show(Clase $clase)
    {
        abort_if(Gate::denies('setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clase->hora_inicio=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_inicio);
        if($clase->hora_final!=null)
        {
            $clase->hora_final=Carbon::createFromFormat('Y-m-d H:i:s',$clase->hora_final);
            $faltas=Falta::all();
    
            $clase->load('faltas');
            return view('admin.clases.show', compact('clase', 'faltas'));
        }
        return back()->with('toast_error', 'No existe hora de finalización de la clase');
    }

    public function destroy(Clase $clase)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clase->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Clase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
