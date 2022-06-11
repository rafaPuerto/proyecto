<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPriceRequest;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Falta;
use App\Grupo;
use App\Subgrupo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaltasController extends Controller
{
    public function index()
    {
        $faltas = Falta::all();
        $subGrupos = Subgrupo::all();
        $grupos=Grupo::all();

        return view('admin.faltas.index', compact('faltas', 'subGrupos','grupos'));
    }

    public function create()
    {
        $amenities = Amenity::all()->pluck('name', 'id');

        return view('admin.prices.create', compact('amenities'));
    }

    public function store(Request $request)
    {
        $price = Price::create($request->all());
        $price->amenities()->sync($request->input('amenities', []));

        return redirect()->route('admin.prices.index');
    }

    public function edit(Price $price)
    {
        abort_if(Gate::denies('price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::all()->pluck('name', 'id');

        $price->load('amenities');

        return view('admin.prices.edit', compact('amenities', 'price'));
    }

    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->update($request->all());
        $price->amenities()->sync($request->input('amenities', []));

        return redirect()->route('admin.prices.index');
    }

    public function show(Price $price)
    {
        abort_if(Gate::denies('price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price->load('amenities');

        return view('admin.prices.show', compact('price'));
    }

    public function destroy(Price $price)
    {
        abort_if(Gate::denies('price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriceRequest $request)
    {
        Price::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
