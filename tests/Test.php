@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<style>
@media only screen and (min-width: 675px) {
    .center-gallery {
        width: 50%;
        margin: auto;
    }
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-180 gd_place type-gd_place status-publish hentry gd_placecategory-hotels">
                        <li id="post_mapTab" style="display: none;">
                            <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                            </div>
                        </li>
                    <header class="container">
                            <div class="col">
                                <h1 class="entry-title"><span style="margin-right: 10rem;">{{ $localidade->localidad }}</span>
                                    @foreach ($pregunta_e_1_1 as $pregunta)
                                        <span class="badge badge-pill badge-success">{{ $pregunta->fortaleza }}</span>
                                    @endforeach
                                </h1>
                            </div>
                    </header>
                    <div id="fotos_container">
                        @if($localidade->photos->count())
                            <div class="geodir-post-slider center-gallery">
                                <div class="bxslider">
                                    @foreach($localidade->photos as $photo)
                                    <div>
                                        <img src="{{ $photo->getUrl('thumb') }}" width="1440" height="960">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="entry-content entry-summary">
                        <div class="geodir-single-tabs-container">
                            <div class="geodir-tabs" id="gd-tabs">
                                <dl class="geodir-tab-head"><dt></dt>
                                    @foreach ($bloques as $bloque)
                                    <?php 
                                        $cadena  = $bloque->bloque;
                                        $nombre = explode(" ", $cadena);
                                    ?>
                                        @if ($loop->index == 0)
                                            <dd class="geodir-tab-active">
                                                <a data-tab="#informacion_{{ $bloque->id }}" data-status="enable">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                    {{ ucfirst($nombre[count($nombre)-1]) }}
                                                </a>
                                            </dd>
                                        @elseif ($loop->index == 1)
                                            <dd class="">
                                                <a data-tab="#informacion_{{ $bloque->id }}" data-status="enable">
                                                    <i class="fa fa-eur" aria-hidden="true"></i>
                                                    {{ ucfirst($nombre[count($nombre)-1]) }}
                                                </a>
                                            </dd>
                                        @elseif ($loop->index == 2)
                                            <dd class="">
                                                <a data-tab="#informacion_{{ $bloque->id }}" data-status="enable">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    {{ ucfirst($nombre[count($nombre)-1]) }}
                                                </a>
                                            </dd>
                                        @elseif ($loop->index == 3)
                                            <dd class="">
                                                <a data-tab="#informacion_{{ $bloque->id }}" data-status="enable">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                    {{ ucfirst($nombre[count($nombre)-1]) }}
                                                </a>
                                            </dd>
                                        @endif
                                    @endforeach
                                </dl>
                                <ul class="geodir-tabs-content geodir-entry-content " style="z-index: 0; position: relative;">
                                    <!--APARTADO A-->
                                    <li id="informacion_1Tab" style="display: none;"><span id="informacion_1"></span>
                                        <div id="geodir-tab-content-informacion_1_1" class="hash-offset"></div>
                                        <div id="apartado_a_1_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Comunicaciones con otras ciudades</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/><i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped" >
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Medio</th>
                                                            <th scope="col">Distancia en kilómetros</th>
                                                            <th scope="col">Kilómetros exactos</th>
                                                            <th scope="col">Ubicación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pregunta_a_1_1 as $pregunta)
                                                        <tr>
                                                            <td>{{ $pregunta->medio }}</td>
                                                            <td>{{ $pregunta->km_rate }}</td>
                                                            @if($pregunta->km_exactos != null)
                                                                <td>{{ $pregunta->km_exactos }}</td>
                                                            @else
                                                                <td>--------------</td>
                                                            @endif
                                                            <td>{{ $pregunta->ubicacion }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="apartado_a_2_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Servicios Municipales</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped" >
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Servicio</th>
                                                            <th scope="col">Disponibilidad</th>
                                                            <th scope="col">Distancia en kilómetros</th>
                                                            <th scope="col">Kilómetros exactos</th>
                                                            <th scope="col">Ubicación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pregunta_a_2_1 as $pregunta)
                                                        <tr>
                                                            <td>{{ $pregunta->servicio }}</td>
                                                            @if ($pregunta->estado == "No")
                                                                <td>No disponible</td>
                                                            @else
                                                                <td>Disponible</td>
                                                            @endif
                                                            @if ($pregunta->km_rate != null)
                                                                <td>{{ $pregunta->km_rate }}</td>
                                                            @else
                                                                <td>--------------</td>
                                                            @endif
                                                            @if ($pregunta->km_exactos != null)
                                                                <td>{{ $pregunta->km_exactos }}</td>
                                                            @else
                                                                <td>--------------</td>
                                                            @endif
                                                            @if ($pregunta->estado == "Sí")
                                                                <td>{{ $localidade->localidad }}</td>
                                                            @else
                                                                <td>{{ $pregunta->ubicacion }}</td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="apartado_a_3_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Comunicaciones con otras ciudades</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    @if (isset($pregunta_a_3_1->estado))
                                                        <h6 class="pt-sm-1 font-weight-bold"><u>Transporte público</u></h6>
                                                        @if ($pregunta_a_3_1->estado != "No")
                                                            <p>Disponible</p>
                                                        @else
                                                            <p>No disponible</p>
                                                        @endif
                                                    @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="pt-sm-1 font-weight-bold"><u>Conexiones con otras localidades</u></h6>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Localidad</th>
                                                                    <th scope="col">Kilómetros exactos</th>
                                                                    <th scope="col">Distancia en kilómetros</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pregunta_a_3_2 as $pregunta)
                                                                    <tr>
                                                                        <td>{{ $pregunta->localidad_conectada }}</td>
                                                                        @if ($pregunta->km_exactos != null)
                                                                            <td>{{ $pregunta->km_exactos }}</td>
                                                                        @else
                                                                            <td>--------------</td>
                                                                        @endif
                                                                        <td>{{ $pregunta->km_rate }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!--APARTADO B-->
                                    <li id="informacion_2Tab">
                                        <div id="geodir-tab-content-informacion_2" class="hash-offset"></div>
                                        <div id="apartado_b_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Poligonos industriales</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                @if (count($pregunta_b_1_1) > 0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Polígono</th>
                                                                <th scope="col">Coordenadas</th>
                                                                <th scope="col">Terreno disponible</th>
                                                                <th scope="col">Terreno Ocupado</th>
                                                                <th scope="col">Suelo Urbanizado</th>
                                                                <th scope="col">Precio</th>
                                                                <th scope="col">Tamaño de la parcela</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_b_1_1 as $pregunta)
                                                                <tr>
                                                                    <td>{{ $pregunta->poligono }}</td>
                                                                    <td style="padding-top: 0%; padding-bottom: 0%">
                                                                        <ul>
                                                                            <li style="padding-top: 0%">{{ $pregunta->latitude }}</li>
                                                                            <li style="padding-bottom: 0%; padding-top: 0%">{{ $pregunta->longitude }}</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>{{ $pregunta->m2_terreno_disponible }}</td>
                                                                    <td>{{ $pregunta->m2_terreno_ocupado }}</td>
                                                                    <td>{{ $pregunta->superficie_suelo_urbanizado }}</td>
                                                                    <td>{{ $pregunta->precio_urbanizacion }}</td>
                                                                    @if ($pregunta->tamano_parcela != null)
                                                                        <td>{{ $pregunta->tamano_parcela }}</td>
                                                                    @else
                                                                        <td>--------------</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No hay polígonos industriales disponibles</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_b_2" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Estrategia de negocio y Proveedores</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <div id="estrategia">
                                                    <h6 class="pt-sm-1 font-weight-bold"><u>Estrategia de negocio</u></h6>
                                                    <p>{{ isset($pregunta_b_2_1->estrategia) }}</p>
                                                </div>
                                                <div id="proveedores">
                                                    <h6 class="pt-sm-1 font-weight-bold"><u>Proveedores</u></h6>
                                                    @if (count($pregunta_b_2_2) > 0)
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Materia Prima</th>
                                                                    <th scope="col">Kilómetros exactos</th>
                                                                    <th scope="col">Distancia en kilómetros</th>
                                                                    <th scope="col">Ubicación</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pregunta_b_2_2 as $pregunta)
                                                                    <tr>
                                                                        <td>{{ $pregunta->materia_prima }}</td>
                                                                        @if ($pregunta->km_exactos != null)
                                                                            <td>{{ $pregunta->km_exactos }}</td>
                                                                        @else
                                                                            <td>--------------</td>
                                                                        @endif
                                                                        <td>{{ $pregunta->km_rate }}</td>
                                                                        <td>{{ $pregunta->localidad_conectada }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No hay proveedores disponibles</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div id="apartado_b_3_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Empresas de construcción</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                @if (count($pregunta_b_3_1) > 0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Empresa</th>
                                                                <th scope="col">Kilómetros exactos</th>
                                                                <th scope="col">Distancia en kilómetros</th>
                                                                <th scope="col">Ubicación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_b_3_1 as $pregunta)
                                                                <tr>
                                                                    <td>{{ $pregunta->empresa }}</td>
                                                                    @if ($pregunta->km_exactos != null)
                                                                        <td>{{ $pregunta->km_exactos }}</td>
                                                                    @else
                                                                        <td>--------------</td>
                                                                    @endif
                                                                    <td>{{ $pregunta->km_rate }}</td>
                                                                    <td>{{ $pregunta->localidad_conectada }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No hay empresas de construcción disponibles</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_b_3_2" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Empresas de transporte de mercancias</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                            @if (count($pregunta_b_3_2) > 0)
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Empresa</th>
                                                            <th scope="col">Kilómetros exactos</th>
                                                            <th scope="col">Distancia en kilómetros</th>
                                                            <th scope="col">Ubicación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pregunta_b_3_2 as $pregunta)
                                                            <tr>
                                                                <td>{{ $pregunta->empresa }}</td>
                                                                @if ($pregunta->km_exactos != null)
                                                                    <td>{{ $pregunta->km_exactos }}</td>
                                                                @else
                                                                    <td>--------------</td>
                                                                @endif
                                                                <td>{{ $pregunta->km_rate }}</td>
                                                                <td>{{ $pregunta->localidad_conectada }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                    <p>No hay empresas de transporte de mercancias disponibles</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_b_3_3" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Ayudas económicas e incentivos fiscales y disponibilidad de banda ancha</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                @if ($pregunta_b_3_3->count() >  0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Ayuda</th>
                                                                <th scope="col">Enlace</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_b_3_3 as $pregunta)
                                                                <tr>
                                                                    <td>{{ $pregunta->ayuda }}</td>
                                                                    <td>
                                                                        <a href="{{ $pregunta->url }}" target="_blank">{{ $pregunta->url }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No se han registrado datos sobre las ayudas económicas</p>
                                                @endif
                                                <div id="apartado_b_4_1" class="pt-3">
                                                    @if (isset($pregunta_b_4_1->estado))
                                                        <h6 class="font-weight-bold"><u>Disponibilidad de banda ancha</u></h6>
                                                        @if ($pregunta_b_4_1->estado != "No")
                                                            <p>Disponible</p>
                                                        @else
                                                            <p>No disponible</p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!--APARTADO C-->
                                    <li id="informacion_3Tab" style="display: none;"><span id="informacion_3"></span>
                                        <div id="geodir-tab-content-informacion_3" class="hash-offset"></div>
                                        <div id="apartado_c_1_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Sectores empresariales estratégicos</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                @if (count($pregunta_c_1_1) > 0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Sector</th>
                                                                <th scope="col">Porcentaje</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_c_1_1 as $pregunta)
                                                            <tr>
                                                                <td>{{ $pregunta->sector }}</td>
                                                                <td>{{ $pregunta->porcentaje }} %</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No se han registrado datos</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_c_2" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Empleo</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tasa de Empleo</th>
                                                            <th scope="col">Tasa de Desempleo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ isset($pregunta_c_2_1->empleo) }} %</td>
                                                            <td>{{ isset($pregunta_c_2_2->desempleo) }} %</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h6 class="pt-4 font-weight-bold"><u>Incentivos para el empleo</u></h6>
                                                @if ($pregunta_c_2_3->count() > 0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Ayuda</th>
                                                                <th scope="col">Enlace</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_c_2_3 as $pregunta)
                                                                <tr>
                                                                    <td>{{ $pregunta->ayuda }}</td>
                                                                    <td>
                                                                        <a href="{{ $pregunta->url }}" target="_blank">{{ $pregunta->url }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No se han registrado datos</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_c_3_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Nivel de formación existente en la localidad</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                @if (count($pregunta_c_3_1) > 0)
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Nivel de formación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pregunta_c_3_1 as $pregunta)
                                                                <tr>
                                                                    <td>{{ $pregunta->nivel_formacion }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>No se han registrado datos</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <!--APARTADO D-->
                                    <li id="informacion_4Tab" style="display: none;"><span id="informacion_4"></span>
                                        <div id="geodir-tab-content-informacion_4" class="hash-offset"></div>
                                        <div id="apartado_d_1_1_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Habitantes</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Número de habitantes</th>
                                                            <th scope="col">Edad media</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ isset($pregunta_d_1_1->habitantes) }}</td>
                                                            <td>{{ isset($pregunta_d_1_1->edad_media) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if (isset($pregunta_d_1_1->vivienda_disponible))
                                                    <h6 class="pt-4 font-weight-bold"><u>Disponibilidad de viviendas</u></h6>
                                                    @if ($pregunta_d_1_1->vivienda_disponible != "No")
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Número de habitaciones</th>
                                                                    <th scope="col">Precio medio</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $pregunta_d_1_1->promedio_habitaciones }}</td>
                                                                    <td>{{ $pregunta_d_1_1->promedio_precio }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No hay viviendas disponibles</p>
                                                    @endif
                                                @endif
                                                @if (isset($pregunta_d_1_1->hoteles))
                                                    <h6 class="pt-4 font-weight-bold"><u>Disponibilidad de hoteles o apartahoteles</u></h6>
                                                    @if ($pregunta_d_1_1->hoteles != "No")
                                                        <p>Disponible</p>
                                                    @else
                                                        <p>No hay hoteles disponible</p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div id="apartado_d_2_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Nivel de renta de la población</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Renta exacta</th>
                                                            <th scope="col">Intervalo de renta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if(isset($pregunta_d_2_1->renta_exacta))
                                                                @if($pregunta_d_2_1->renta_exacta == null)
                                                                    <td>No disponible</td>
                                                                @else
                                                                    <td>{{ $pregunta_d_2_1->renta_exacta }} €</td>
                                                                @endif
                                                            @endif
                                                                <td>{{ isset($pregunta_d_2_1->renta_rate) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="apartado_d_3_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Servicios para el ocio</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Ocio</th>
                                                            <th>Disponibilidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pregunta_d_3_1 as $pregunta)
                                                            <tr>
                                                                @if ($pregunta->estado == "Sí")
                                                                    <td>{{ $pregunta->ocio }}</td>
                                                                    <td>Disponible</td>
                                                                @else
                                                                    <td>{{ $pregunta->ocio }}</td>
                                                                    <td>No disponible</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <!--APARTADO E-->
                                    <!--
                                    <li id="informacion_5Tab" style="display: none;"><span id="informacion_5"></span>
                                        <div id="geodir-tab-content-informacion_5" class="hash-offset"></div>
                                        <div id="apartado_e_1_1" class="card card-warning col-md-12 collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Fortalezas</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"/>
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                            <div class="card-body" style="display: none;">
                                                <table class="table table-striped">
                                                    <tbody >
                                                        @foreach ($pregunta_e_1_1 as $pregunta)
                                                            <tr>
                                                                <td>{{ $pregunta->fortaleza }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                -->
                                </ul>
                            </div>
                        </div>
                        <div class="geodir-single-taxonomies-container">
                            <div class="geodir-pos_navigation clearfix">
                                <div class="geodir-post_left">
                                    <a href="javascript:history.back()" rel="prev">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<!-- jQuery -->

<script type="text/javascript">

if (window.location.hash && window.location.hash.indexOf('&') === -1 && jQuery(window.location.hash + 'Tab').length) {
    hashVal = window.location.hash;
} else {
    hashVal = jQuery('dl.geodir-tab-head dd.geodir-tab-active').find('a').attr('data-tab');
}
openTab(hashVal);

jQuery('dl.geodir-tab-head dd a').click(function() {
    openTab(jQuery(this).data('tab'))
});

function openTab(hashVal)
{
    jQuery('dl.geodir-tab-head dd').each(function() {
        var tab = '';
        tab = jQuery(this).find('a').attr('data-tab');
        jQuery(this).removeClass('geodir-tab-active');
        if (hashVal != tab) {
            jQuery(tab + 'Tab').hide();
        }
    });
    jQuery('a[data-tab="'+hashVal+'"]').parent().addClass('geodir-tab-active');
    jQuery(hashVal + 'Tab').show();
}

$(function(){
    $('.bxslider').bxSlider({
        mode: 'fade',
        slideWidth: 600
    });
});
</script>

@if($localidade->latitud && $localidade->longitud)
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=ES'></script>
    <script defer>
        function initialize() {
            var latLng = new google.maps.LatLng({{ $localidade->latitud }}, {{ $localidade->longitud }});
            var mapOptions = {
                zoom: 14,
                minZoom: 6,
                maxZoom: 17,
                zoomControl:true,
                zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT
                },
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                panControl:false,
                mapTypeControl:false,
                scaleControl:false,
                overviewMapControl:false,
                rotateControl:false
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = new google.maps.MarkerImage("{{ asset('assets/images/pin.png') }}", null, null, null, new google.maps.Size(40,52));

            var marker = new google.maps.Marker({
                position: latLng,
                icon:image,
                map: map,
                title: '{{ $localidade->localidad }}'
            });
            
			var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'hover', (function (marker) {
                /*return function () {
                    infowindow.setContent(content)
                    infowindow.open(map, marker);
                }*/
            })(marker));
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endif
@endsection