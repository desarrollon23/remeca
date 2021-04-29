<x-app-layout>
    @php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
    <div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
      <div class="card-header"><h3 class="card-title"><strong>VENTAS -> Material por Pagar</strong></h3></div>
      <div class="content">
        <div class="container-fluid">
          <div class="row aling: center">
            <div class="col-lg-12 col-md-12 col-xs-6 mt-2">
              <div class="card">
                <div class="card-header bg-info"><h3 class="card-title" style="color: #000;"><label class="d-flex justify-content-center">Material:&nbsp;</label></h3>
                  <h3 class="card-title" style="color: #fff;"><label>
                  {{ traerdescripcionproducto($cdmvpp[0]->idproducto) }}</label></h3>
                  <h3 class="card-title" style="color: #000;"><label>&nbsp;&nbsp;&nbsp;Total por Pagar:&nbsp;</label></h3>
                  <h3 class="card-title" style="color: #fff;"><label>
                  {{ $formatter->formatCurrency($cdmvpp->sum('debe'), ''), PHP_EOL }} 
                  &nbsp;KG</label></h3></div>
                <div class="card-body">
                  @if ($cdmvpp->count())
                  <table id="example" class="table table-bordered table-striped" style="width: 100%;"><thead>
                    <tr>
                      <td colspan="5" style="text-align: center;">
                        <strong>
                          CUENTAS POR PAGAR DEL MATERIAL: {{ traerdescripcionproducto($cdmvpp[0]->idproducto) }}
                        </strong>
                      </td>
                    </tr>
                      <tr> 
                        <th scope="col" style="width: 20%;">NEGOCIACION</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">CEDULA</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">PAGAR</th>
                      </tr></thead><tbody>
                      @foreach ($cdmvpp as $producto)<tr class="hover:bg-green-200">
                        <td scope="row" class="px-1 py-1">{{ $producto->negociacion }}</td>
                        <td class="px-1 py-1">{{ $producto->fecha }}</td>
                        <td class="px-1 py-1">{{ $producto->cedula }}</td>
                        <td class="px-1 py-1">{{ $producto->nombre }}</td>
                        <td class="px-1 py-1" style="text-align: right;">{{$formatter->formatCurrency($producto->debe, ''), PHP_EOL}}</td></tr>
                      @endforeach
                      <tfoot>
                        <tr>
                          <td colspan="5" style="text-align: right;"><strong>
                            TOTAL POR PAGAR: {{ $formatter->formatCurrency($cdmvpp->sum('debe'), ''), PHP_EOL }} KG</strong>
                          </td>
                        </tr>
                      </tfoot>
                    </tbody>
                  </table>
                  @else
                      {{ "No existen Inventario para este Material" }}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </x-app>
    