<x-app-layout>
<style>
/* INICIO DEL ACORDEON */
button.accordion { cursor: pointer; padding: 10px; width: 100%; outline: none; font-size: 15px; transition: 0.4s; }
button.accordion.active, button.accordion:hover { background-color:#da7777; }
div.panel { padding: 0 10px; width: 100%; display: none; background-color: #fff; }
div.panel.show { display: block !important; }
button.accordiond { cursor: pointer; padding: 10px; width: 100%; outline: none; font-size: 15px; transition: 0.4s; }
button.accordiond.active, button.accordiond:hover { background-color: #da7777; }
div.detalle { padding: 0 10px; display: none; background-color: white; }
div.detalle.show { display: block !important; }
/* FIN DEL ACORDEON */
</style>
@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">
    <div class="card-header"><h1 class="card-title text-info">
      <strong>ADMINISTRACION -> Ventas - CPP (KG) & CPC ($)</strong>
    </h1></div>
    {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
  @if ($totalnegov->count())
    <div x-data="main()" class="content">
      <div class="container-fluid mx-auto">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
            <div class="row aling: center" >
              <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
                <div class="card">
                  <div class="card-header bg-info"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Cliente</h3></div></div>
                  <div class="card-body grid grid-cols-2">
                    <div><label style="width: 100%; margin-right: 2px;">Cédula o Rif: {{ $totalnegov[0]->cedula }}</label></div>
                    <div><label style="width: 100%; margin-right: 2px;">Nombre: {{ $totalnegov[0]->nombre }}</label></div>
                  </div>
                </div>
              </div>{{-- Lista de Materiales #336699 --}}
              <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
                <div class="card">
                  @php
                  
                  /* $sumamonto=(double)$negociaciones[0]->montotn+(double)$creditos[0]->montototal;
                  $sumapagado=(double)$negociaciones[0]->totalpagado+(double)$creditos[0]->totalpagado;
                  $sumaresta=(double)$negociaciones[0]->restan+(double)$creditos[0]->totalresta; */
                      /* dd(
                         ' montotn='.$negociaciones[0]->montotn
                        .' - totalpagado='.$negociaciones[0]->totalpagado
                        .' - restan='.$negociaciones[0]->restan
                        .' - montototal='.$creditos[0]->montototal
                        .' - totalpagado='.$creditos[0]->totalpagado
                        .' - totalresta='.$creditos[0]->totalresta
                        .' - sumamonto='.$sumamonto
                        .' - sumapagado='.$sumapagado
                        .' - sumaresta='.$sumaresta
                      ); */
                      /* $sumamonto=(double)$creditos->sum('montototal');
                      $sumapagado=(double)$creditos->count();
                      dd(
                          ' Suma creditos='.$sumamonto.
                          ' creditos='.$sumapagado
                        ); */
                  
                      if($negociaciones->count()>0 and $creditos->count()>0){
                        $sumamonto=(double)$negociaciones->sum('montotn')+(double)$creditos->sum('montototal');
                        $sumapagado=(double)$negociaciones->sum('totalpagado')+(double)$creditos->sum('totalpagado');
                        $sumaresta=(double)$negociaciones->sum('restan')+(double)$creditos->sum('totalresta');
                      }elseif($negociaciones->count()==0 and $creditos->count()>0){
                        $sumamonto=(double)$creditos->sum('montototal');
                        $sumapagado=(double)$creditos->sum('totalpagado');
                        $sumaresta=(double)$creditos->sum('totalresta');
                      }elseif($negociaciones->count()>0 and $creditos->count()==0){
                        $sumamonto=(double)$negociaciones->sum('montotn');
                        $sumapagado=(double)$negociaciones->sum('totalpagado');
                        $sumaresta=(double)$negociaciones->sum('restan');
                      }
                  @endphp
                  <div class="card-header bg-info">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Lista de  Negociaciones y Créditos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto $: 
                      {{ $formatter->formatCurrency($sumamonto, ''), PHP_EOL }}
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pagado $: 
                      {{ $formatter->formatCurrency($sumapagado, ''), PHP_EOL }}
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resta $: 
                      {{ $formatter->formatCurrency($sumaresta, ''), PHP_EOL }}
                    </h3></div>
                  </div>
                  <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                    @foreach ($negociaciones as $negociacion)
                    <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
                      <div class="card">
                        <div class="card-header bg-info">
                          <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">
                              Negociación #: {{ $negociacion->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              Fecha: {{ $negociacion->fechan }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              Tipo de Pago: 
                              @if($negociacion->idtipopagon==1) {{ 'De Contado' }} @endif
                              @if($negociacion->idtipopagon==2) {{ 'A Crédito' }} @endif
                            </h3>
                            </div>
                          </div>
                          <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <div><label style="width: 100%; margin-right: 2px;">Factura: 
                              @if($amortizacionesdepago->count())
                            {{ $amortizacionesdepago->where('negociacion',$negociacion->id)->pluck('factura')[0] }}
                            @endif
                            </label></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div><label style="width: 100%; margin-right: 2px;">Observaciones: {{ $negociacion->observaciones }}</label></div>
                          </div>{{-- DETALLE DE NEGOCIACION --}}
                          <table class="table table-striped"><thead><tr>
                              <th scope="col">MATERIAL</th>
                              <th scope="col">KG</th><th scope="col"></th>
                              <th scope="col">PRECIO $</th><th scope="col"></th>
                              <th scope="col">TOTAL $</th>
                            </tr></thead><tbody>
                              @foreach ($productosrecepcion as $productorecepcion)
                                @if ($negociacion->id==$productorecepcion->negociacion_id)
                                @php $cantidades[$loop->iteration]=$productorecepcion->cantidadprorecmatn  @endphp
                                <tr><td scope="row">{{ $productorecepcion->descripcion }}</td>
                                  <td>{{ $formatter->formatCurrency($productorecepcion->cantidadprorecmatn, ''), PHP_EOL }}</td>
                                  <td><a><i class="color danger fas fa-asterisk text-success"></i></a></td>
                                  <td>{{ $formatter->formatCurrency($productorecepcion->precionegn, ''), PHP_EOL }}</td>
                                  <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                                  <td>{{ $formatter->formatCurrency($productorecepcion->totalpronegn, ''), PHP_EOL }}
                                  </td>
                                  </td>
                                </tr>
                                @endif
                              @endforeach</tbody>
                            <tfoot><tr>
                              <td><label>TOTAL</label></td>
                              <td></td><td></td><td></td><td></td>
                              <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($negociacion->montotn, ''), PHP_EOL }}</h1>
                              </td></tr>
                            </tfoot>
                          </table>

                          {{-- AMORTIZACIONES DE PAGO --}}
                          @if($negociacion->idtipopagon==2)
                          <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            @if ($amortizacionesdepago->where('negociacion',$negociacion->id)->count())
                              <label style="text-align: center; color: #17a2b8; ">AMORTIZACIONES DE PAGO $</label>
                              <table class="table table-striped"><thead><tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">FECHA - HORA</th>
                                <th scope="col">P/EFECTIVO $</th>
                                <th scope="col">P/TRANSFERENCIA $</th>
                                <th scope="col">PAGO $</th>
                                <th scope="col">RESTA $</th>
                                </tr></thead><tbody>
                                @foreach ($amortizacionesdepago->where('negociacion',$negociacion->id) as $amortizaciondepago)
                                  <tr>{{-- <td scope="row">{{ $loop->iteration }}</td> --}}
                                    <td>{{ $amortizaciondepago->fecha.' '.$amortizaciondepago->hora }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->efectivo, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->transferencia, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->pago, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->resta, ''), PHP_EOL }}</td>
                                    </td>
                                  </tr>
                                @endforeach</tbody>
                              </table>
                            @else <h1 style="font-weight:900;">{{ 'No tiene Amortizaciones de Pago'}}</h1>@endif
                          </div>
                          @endif
                          {{-- ABONOS DE MATERIALES --}}
                          <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            @if ($productosabonados->where('negociacion',$negociacion->id)->count())
                              <label style="text-align: center; color: #17a2b8; ">ABONOS DE MATERIALES KG</label>
                              <table class="table table-striped"><thead><tr>
                                {{-- <th scope="col"># DESPACHO</th> --}}
                                <th scope="col">FECHA</th>
                                <th scope="col">MATERIAL</th>
                                <th scope="col">ABONO KG</th>
                                <th scope="col">DEBE KG</th>
                                </tr></thead><tbody>
                                @foreach ($productosabonados->where('negociacion',$negociacion->id)->where('despacho', '>', 0) as $productoabonado)
                                  <tr>{{-- <td scope="row">{{ $productoabonado->despacho }}</td> --}}
                                    <td>{{ $productoabonado->fecha }}</td>
                                    <td>{{ $productoabonado->material }}</td>
                                    <td>{{ $formatter->formatCurrency($productoabonado->abono, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($productoabonado->debe, ''), PHP_EOL }}</td>
                                  </tr>
                                @endforeach</tbody>
                              </table>
                            @else <h1 style="font-weight:900;">{{ 'No tiene Abonos de Materiales'}}</h1> @endif
                          </div>

                        </div>
                      </div>
                    @endforeach

                    {{-- AMORTIZACIONES A CREDITOS --}}
                    @foreach ($creditos as $credito)
                    <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
                      <div class="card">
                        <div class="card-header bg-info">
                          <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">
                              Crédito #: {{ $credito->idventa }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              Fecha: {{ $credito->fecha }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                            </div>
                          </div>
                          <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <div><label style="width: 100%; margin-right: 2px;">Factura: 
                              @if($amortizacionesdepago->count())
                            {{ $amortizacionesdepago->where('factura',$credito->idventa)->pluck('factura')[0] }}
                            @endif
                            </label></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div><label style="width: 100%; margin-right: 2px;">Observaciones: {{ $credito->observaciones }}</label></div>
                          </div>{{-- DETALLE DE NEGOCIACION --}}
                      {{-- @php dd($creditos);  @endphp --}}
                          {{-- ABONOS A CREDTOS --}}
                          @if ($amortizacionesdepago->where('id',$credito->id)->count())
                            <label style="text-align: center; color: #17a2b8; width: 100%;">AMORTIZACIONES DE PAGO</label><label style="text-align: right;font-weight:900; color:red; width: 95%;">CREDITO POR:
                                {{ $formatter->formatCurrency($amortizacionesdepago->where('id',$credito->id)->pluck('monto')[0], ''), PHP_EOL }}</label>
                            <table class="table table-striped"><thead><tr>
                              <th scope="col" colspan="2">FECHA - HORA</th>
                              <th scope="col">EFECTIVO</th>
                              <th scope="col">TRANSFERENCIA</th>
                              <th scope="col">PAGADO</th>
                              <th scope="col">DEBIA</th>
                              </tr></thead><tbody>
                              @foreach ($amortizacionesdepago->where('id',$credito->id) as $amortizaciondepago)
                                {{-- <tr><td scope="row">{{ $loop->iteration }}</td> --}}
                                  <td colspan="2">{{ $amortizaciondepago->fecha }} - {{ $amortizaciondepago->hora }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->efectivo, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->transferencia, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->pago, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->resta, ''), PHP_EOL }}</td>
                                </tr>
                              @endforeach</tbody>
                            </table>
                          @else <h1 style="font-weight:900;">{{ 'No tiene Amortizaciones de Pago'}}</h1>@endif


                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else <h1 style="font-weight:900;">{{ 'No tiene Consultas'}}</h1>@endif
</div>
</x-app>