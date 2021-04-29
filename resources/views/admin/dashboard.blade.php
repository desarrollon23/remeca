<x-admin-layout>
  @php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
  <div style="background: white;"> {{-- {{ current_user()->name }} --}}
    {{-- <div style="background-image: url('../../../../img/fdashboardv.png'); width: 100%; height: 100vh;  min-height: 100vh;"> --}}
    {{-- <div style="background: url(../../../../img/fdashboardv.png) no-repeat fixed center;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 100%; width: 100%;"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Página Principal</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-6">{{-- ENTRADA DE MATERIAL --}}
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="color: #fff; text-shadow: 2px 2px 2px black;">{{ $emd->count() }}</h3>
                <p style="text-shadow: 2px 2px 2px black;">Entrada de Material por día</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">{{-- DESPACHO DE MATERIAL --}}
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 style="color: #fff; text-shadow: 2px 2px 2px black;">{{ $dmd->count() }}<sup style="font-size: 20px"></sup></h3>
                <p style="text-shadow: 2px 2px 2px black;">Entrega de Material</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">{{-- COMPRAS CTAS: P/C (KG) - P/P ($) --}}
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 style="color: white; text-shadow: 2px 2px 2px black;">{{ 
                $formatter->formatCurrency($ccpp->sum('monto'), ''), PHP_EOL
                /* $formatter->formatCurrency($ccpp->sum('diferenciapago'), ''), PHP_EOL */
                 }}</h3>
                <p style="color: white; text-shadow: 2px 2px 2px black;">COMPRAS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">{{-- VENTAS CTAS: P/C ($) - P/P (KG) --}}
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="color: #fff; text-shadow: 2px 2px 2px black;">{{ $formatter->formatCurrency($ccpc->sum('monto'), ''), PHP_EOL }}</h3>
                <p style="text-shadow: 2px 2px 2px black;">VENTAS P/Cobrar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">{{-- EFECTIVO --}}
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                <h3 style="color: #fff; text-shadow: 2px 2px 2px black;">{{$formatter->formatCurrency($efectivo[0], ''), PHP_EOL}}{{-- {{ $ccpc->sum('monto') }} --}}</h3>
                <p style="text-shadow: 2px 2px 2px black;">EFECTIVO</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">{{-- BANCO --}}
            <!-- small box -->
            <div class="small-box bg-orange" style="color: #fff;">
              <div class="inner">
                <h3 style="color: #fff; text-shadow: 2px 2px 2px black;">{{$formatter->formatCurrency($banco[0], ''), PHP_EOL}}{{-- {{ $ccpc->sum('monto') }} --}}</h3>
                <p style="color: #fff; text-shadow: 2px 2px 2px black;">EN BANCO</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">{{-- INVENTARIO --}}
            <div class="card">
              <div class="card-header bg-warning" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center" style="text-shadow: 2px 2px 2px black;">Inventario&nbsp;
                <h2>{{ $inventarios->count() }}</h2></label></h3>
              </div>
              <div class="card-body">
                @if ($inventarios->count())
                <div style="width: 100%; margin-right: 2px;">
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Material</th>
                    <th scope="col">KG</th>
                    <th scope="col">P/C</th>
                    <th scope="col">P/P</th>
                  </tr></thead><tbody>
                  @foreach ($inventarios as $inventario)<tr class="hover:bg-green-200">
                    {{-- <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td> --}}
                    <td class="px-1 py-1">{{$inventario->descripcion}}</td>
                    <td class="px-1 py-1" style="text-align: right;">{{$formatter->formatCurrency($inventario->cantidad, ''), PHP_EOL}}</td>
                    <td class="px-1 py-1" style="text-align: right;">
                      {{-- {{$formatter->formatCurrency($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpc')[0], ''), PHP_EOL}} --}}
                      @if ($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpc')[0]>0)
                         <a href="{{ route('livewire.compras.materialporcobrar', $inventario->id) }}">{{$formatter->formatCurrency($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpc')[0], ''), PHP_EOL}}</a>
                      @else
                         {{$formatter->formatCurrency($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpc')[0], ''), PHP_EOL}}
                      @endif
                    </td>
                    <td class="px-1 py-1" style="text-align: right;">
                      @if ($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpp')[0]>0)
                         <a href="{{ route('livewire.ventas.materialporpagar', $inventario->id) }}">{{$formatter->formatCurrency($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpp')[0], ''), PHP_EOL}}</a>
                      @else
                         {{$formatter->formatCurrency($materialcppcpc->where('idproducto', $inventario->id)->pluck('cpp')[0], ''), PHP_EOL}}
                      @endif
                      {{-- {{$formatter->formatCurrency($inventario->pagar, ''), PHP_EOL}} --}}
                    </td><td>
                      <a href="{{ route('livewire.almacen.inventario', $inventario->id) }}"><i class="fa fa-edit mr-2"></i></a>
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
                @else
                    {{ 'No tiene Materiales en Inventario' }}
                @endif
              </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">{{-- COMPRAS CTAS: P/C (KG) - P/P ($) --}}
            <div class="card">
              <div class="card-header bg-danger" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center" style="text-shadow: 2px 2px 2px black;">Negociaciones de Compras:&nbsp;
                <h2>{{-- {{ $ccpp->count() }} --}}</h2></label></h3>
              </div>
              <div class="card-body">
                @if ($ccpp->count())
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">P/P $</th>
                    {{-- <th scope="col">C/Kg</th> --}}
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($ccpp as $cp)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td>
                    <td class="px-1 py-1">{{$cp->nombre}}</td>
                    <td class="px-1 py-1" style="text-align: right;">{{$formatter->formatCurrency($cp->monto, ''), PHP_EOL}}</td>
                    {{-- <td class="px-1 py-1">{{$cp->pesotn}}</td> --}}
                    <td class="px-1 py-1">
                      <a href="{{ route('livewire.compras.detallenegociacion', $cp->cedula) }}" {{-- wire:click.prevent="edit({{ $pc }})" --}}><i class="fa fa-edit mr-2"></i></a>
                      {{-- <a href="" wire:click.prevent="edit({{ $cp }})"><i class="fa fa-edit mr-2"></i></a> --}}
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
                @else
                    {{ 'No tiene Cuentas por Pagar'}}
                @endif
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">{{-- VENTAS CTAS: P/C ($) - P/P (KG) --}}
            <div class="card">
              <div class="card-header bg-info" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center" style="text-shadow: 2px 2px 2px black;">Negociaciones de Ventas:&nbsp;
                <h2>{{-- {{ $ccpc->count() }} --}}</h2> </label></h3>
              </div>
              <div class="card-body">
                @if ($ccpc->count())
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">P/C $</th>
                    {{-- <th scope="col">P/Kg</th> --}}
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($ccpc as $pc)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td>
                    <td class="px-1 py-1">{{$pc->nombre}}</td>
                    <td class="px-1 py-1" style="text-align: right;">{{$formatter->formatCurrency($pc->monto, ''), PHP_EOL}}</td>
                    <td class="px-1 py-1">
                      <a href="{{ route('livewire.ventas.detallenegociacion', $pc->cedula) }}" {{-- wire:click.prevent="edit({{ $pc }})" --}}><i class="fa fa-edit mr-2"></i></a>{{-- <a href="{{ route('livewire.ventas.detallenegociacion', $pc->cedula) }}" --}} {{-- wire:click.prevent="edit({{ $pc }})" >--}}{{-- <i class="fa fa-edit mr-2"></i> --}}{{-- </a> --}}
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
                @else
                    {{ 'No tiene Cuentas por Cobrar'}}
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">{{-- RECEPCION DIARIA DE MATERIALES --}}
            <div class="card">
              <div class="card-header bg-danger"><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center" style="text-shadow: 2px 2px 2px black;">RECEPCION DIARIA DE MATERIALES (KG)&nbsp;</label></h3>
              </div>
              <div class="card-body">
                @if ($inventarios->count())
                <div style="width: 100%; margin-right: 2px;">
                <table id="example" name="tbl_compras" class="table table-bordered table-striped"><thead><tr> 
                    <th scope="col" style="font-size: 10px; text-align: center;">NOMBRE</th>
                    @foreach ($productosrd as $productord)
                      @if ($productord->id>1)
                        <th scope="col" style="font-size: 10px;">
                          <label>{{$productord->descripcion}}: {{ traetotalcantidadcomprasrd($productord->id, date('d-m-Y')) }}{{-- : {{traemcventasrd($productord->id)}} --}}</label>
                          {{-- <label>CPC:{{traemcpcventasrd($productord->id)}}</label><label>CPP:{{traemcppventasrd($productord->id)}}</label> --}}
                        @endif 
                      </th>
                    @endforeach
                  </tr></thead><tbody>
                    @foreach ($proveedoresrd as $proveedor) {{-- dtos del cliente --}}
                      <tr scope="col"><td style="font-size: 10px;">{{$proveedor->nombre." ".$proveedor->cedula}}</td>
                        @foreach ($productosrd as $productordproveedor) {{-- datos de la venta --}}
                          @if ($productordproveedor->id>1)
                            <td style="text-align: right;">{{ traecantidadcomprasrd($proveedor->cedula, $productordproveedor->id, date('d-m-Y')) }}</td>
                          @endif
                        @endforeach
                      </tr>
                    @endforeach
                  </tr></tbody>
                  <tfoot>
                    <tr><td>TOTAL</td>
                      @foreach ($productosrd as $productord)
                        @if ($productord->id>1)
                          <td style="text-align: right;">
                            {{ traetotalcantidadcomprasrd($productord->id, date('d-m-Y')) }}
                          </td>
                        @endif
                      @endforeach
                    </tr>        
                  </tfoot>
                </table>
                @else
                    {{ 'No tiene Materiales en Inventario' }}
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">{{-- ENTREGA DIARIA DE MATEERIALES  --}}
            <div class="card">
              <div class="card-header bg-info"><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center" style="text-shadow: 2px 2px 2px black;">ENTREGA DIARIA DE MATERIALES (KG)&nbsp;</label></h3>
              </div>
              <div class="card-body">
                @if ($inventarios->count())
                <div style="width: 100%; margin-right: 2px;">
                <table id="exampl" name="tbl_ventas" class="table table-bordered table-striped"><thead><tr> 
                    <th scope="col" style="font-size: 10px; text-align: center;">NOMBRE</th>
                    @foreach ($productosrd as $productord)
                      @if ($productord->id>1)
                        <th scope="col" style="font-size: 10px;">
                          <label>{{$productord->descripcion}}: {{ traetotalcantidadventasrd($productord->id, date('d-m-Y')) }}{{-- : {{traemcventasrd($productord->id)}} --}}</label>
                          {{-- <label>CPC:{{traemcpcventasrd($productord->id)}}</label><label>CPP:{{traemcppventasrd($productord->id)}}</label> --}}
                        @endif
                      </th>
                    @endforeach
                  </tr></thead><tbody>
                    @foreach ($clientesrd as $clienterd) {{-- datos del cliente --}}
                      <tr scope="col"><td style="font-size: 10px;">{{$clienterd->nombrec." ".$clienterd->cedulac}}</td>
                        @foreach ($productosrd as $productordcliente) {{-- datos de la venta --}}
                          @if ($productordcliente->id>1)
                            <td style="text-align: right;">{{ traecantidadventasrd($clienterd->cedulac, $productordcliente->id, date('d-m-Y')) }}</td>
                          @endif
                        @endforeach
                      </tr>
                    @endforeach
                  </tr></tbody>
                  <tfoot>
                    <tr><td>TOTAL</td>
                      @foreach ($productosrd as $productord)
                        @if ($productord->id>1)
                          <td style="text-align: right;">
                            {{ traetotalcantidadventasrd($productord->id, date('d-m-Y')) }}
                          </td>
                        @endif
                      @endforeach
                    </tr>        
                  </tfoot>
                </table>
                @else
                    {{ 'No tiene Materiales en Inventario' }}
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>