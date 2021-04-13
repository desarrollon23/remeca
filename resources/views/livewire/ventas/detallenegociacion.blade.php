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
      <strong>ADMINISTRACION -> Negociaciones de Ventas</strong>
    </h1></div>
    {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
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
                  <div class="card-header bg-info">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Lista de  Negociaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto: 
                      {{ $formatter->formatCurrency($totalnegov[0]->monto, ''), PHP_EOL }}</h3></div>
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
                            </div></div>
                          <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <div><label style="width: 100%; margin-right: 2px;">Factura: {{
                            $amortizacionesdepago->where('negociacion',$negociacion->id)->pluck('factura') }}</label></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div><label style="width: 100%; margin-right: 2px;">Observaciones: {{ $negociacion->observaciones }}</label></div>
                          </div>
                          <table class="table table-striped"><thead><tr>
                              <th scope="col">MATERIAL</th>
                              <th scope="col">KG</th><th scope="col"></th>
                              <th scope="col">PRECIO</th><th scope="col"></th>
                              <th scope="col">TOTAL</th>
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
                              <label style="text-align: center; color: #17a2b8; ">AMORTIZACIONES DE PAGO</label>
                              <table class="table table-striped"><thead><tr>
                                <th scope="col">#</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">EFECTIVO</th>
                                <th scope="col">TRANSFERENCIA</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">RESTA</th>
                                </tr></thead><tbody>
                                @foreach ($amortizacionesdepago->where('negociacion',$negociacion->id) as $amortizaciondepago)
                                  <tr><td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $amortizaciondepago->fecha }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->efectivo, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->transferencia, ''), PHP_EOL }}</td>
                                    <td>{{ $formatter->formatCurrency($amortizaciondepago->total, ''), PHP_EOL }}</td>
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
                              <label style="text-align: center; color: #17a2b8; ">ABONOS DE MATERIALES</label>
                              <table class="table table-striped"><thead><tr>
                                <th scope="col">FACTURA</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">MATERIAL</th>
                                <th scope="col">ABONO</th>
                                </tr></thead><tbody>
                                @foreach ($productosabonados->where('negociacion',$negociacion->id) as $productoabonado)
                                  <tr><td scope="row">{{ $productoabonado->factura }}</td>
                                    <td>{{ $productoabonado->fecha }}</td>
                                    <td>{{ $productoabonado->material }}</td>
                                    <td>{{ $formatter->formatCurrency($productoabonado->abono, ''), PHP_EOL }}</td>
                                    </td>
                                  </tr>
                                @endforeach</tbody>
                              </table>
                            @else <h1 style="font-weight:900;">{{ 'No tiene Abonos de Materiales'}}</h1> @endif
                          </div>
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
</div>
</x-app>