<x-app-layout>
@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title"><strong>ALMACEN -> Inventario de Materiales</strong></h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-warning"><h3 class="card-title" style="color: #000;"><label class="d-flex justify-content-center">Relación del Material:&nbsp;</label></h3>
              {{-- @php dd($inventario[0]); @endphp --}}
              <h3 class="card-title" style="color: #fff;"><label>
              {{$inventario[0]->descripcion}} </label></h3>
              <h3 class="card-title" style="color: #000;"><label>&nbsp;&nbsp;&nbsp;Existencia Actual:&nbsp;</label></h3>
              <h3 class="card-title" style="color: #fff;"><label>
              {{ $formatter->formatCurrency($inventario[0]->cantidad, ''), PHP_EOL }} 
              &nbsp;KG</label></h3></div>
            <div class="card-body">
              {{-- @php dd($inventario[0]); @endphp --}}
              @if ($inventario->count())
              <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">FECHA</th>
                    <th scope="col">HORA</th>
                    <th scope="col">COMPRADOS</th>
                    <th scope="col">VENDIDOS</th>
                    <th scope="col">EXISTENCIA</th>
                  </tr></thead><tbody>
                  @foreach ($inventario as $producto)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$producto->fecha}}</td>
                    <td class="px-1 py-1">{{$producto->hora}}</td>
                    <td class="px-1 py-1">{{$formatter->formatCurrency($producto->comprados, ''), PHP_EOL}}</td>
                    <td class="px-1 py-1">{{$formatter->formatCurrency($producto->vendidos, ''), PHP_EOL}}</td>
                    <td class="px-1 py-1">{{$formatter->formatCurrency($producto->existencia, ''), PHP_EOL}}</td></tr>
                  @endforeach</tbody>
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
