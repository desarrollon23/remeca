<x-app-layout>
    @php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
    <div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
      <div class="card-header"><h3 class="card-title"><strong>COMPRAS -> Material por Cobrar</strong></h3></div>
      <div class="content">
        <div class="container-fluid">
          <div class="row aling: center">
            <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
              <div class="card">
                <div class="card-header bg-danger"><h3 class="card-title" style="color: #000;"><label class="d-flex justify-content-center">Material:&nbsp;</label></h3>
                  <h3 class="card-title" style="color: #fff;"><label>
                  {{ traerdescripcionproducto($cdmcpc[0]->idproducto) }}</label></h3>
                  <h3 class="card-title" style="color: #000;"><label>&nbsp;&nbsp;&nbsp;Total por Cobrar:&nbsp;</label></h3>
                  <h3 class="card-title" style="color: #fff;"><label>
                  {{ $formatter->formatCurrency($cdmcpc->sum('debe'), ''), PHP_EOL }} 
                  &nbsp;KG</label></h3></div>
                <div class="card-body">
                  @if ($cdmcpc->count())
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td colspan="5" style="text-align: center;">
                          <strong>
                            CUENTAS POR COBRAR DEL MATERIAL: {{ traerdescripcionproducto($cdmcpc[0]->idproducto) }}
                          </strong>
                        </td>
                      </tr>
                        <th scope="col" style="width: 20%">NEGOCIACION</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">CEDULA</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">DEBE</th>
                      </tr></thead><tbody>
                      @foreach ($cdmcpc as $producto)<tr class="hover:bg-green-200">
                        <td scope="row" class="px-1 py-1">{{ $producto->negociacion }}</td>
                        <td class="px-1 py-1">{{ $producto->fecha }}</td>
                        <td class="px-1 py-1">{{ $producto->cedula }}</td>
                        <td class="px-1 py-1">{{ $producto->nombre }}</td>
                        <td class="px-1 py-1" style="text-align: right;">{{$formatter->formatCurrency($producto->debe, ''), PHP_EOL}}</td></tr>
                      @endforeach</tbody>
                      <tfoot>
                        <tr>
                          <td colspan="5" style="text-align: right;"><strong>
                            TOTAL POR COBRAR: {{ $formatter->formatCurrency($cdmcpc->sum('debe'), ''), PHP_EOL }}</strong>
                          </td>
                        </tr>
                      </tfoot>
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
    