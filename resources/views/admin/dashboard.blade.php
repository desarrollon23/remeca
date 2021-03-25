<x-admin-layout>
  <div style="background: white;">
    {{-- <div style="background-image: url('../../../../img/fdashboardv.png'); width: 100%; height: 100vh;  min-height: 100vh;"> --}}
    {{-- <div style="background: url(../../../../img/fdashboardv.png) no-repeat fixed center;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 100%; width: 100%;"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Página Principal</h1>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>50</h3>
                <p>Entrada de Material</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>33<sup style="font-size: 20px"></sup></h3>
                <p>Despacho de Material</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>15</h3>
                <p>INVENTARIO</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Detalle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>FINANZAS</p>
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
          @php
            function conn(){
              $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
              mysqli_select_db($conn,'remeca');
              return $conn;
            }
            function traesuma($campos, $tabla, $criterio, $buscar){
              $sqltrol='SELECT '.$campos.' FROM '.$tabla.' WHERE '.$criterio.'='.$buscar;
              $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
              $datrol=mysqli_fetch_array($restrol);
              $descmat=$datrol[0];
              mysqli_free_result($restrol);
              return $descmat;
            }
            function traeresumen($campos, $tabla, $criterio, $buscar){
              $sqltrol='SELECT '.$campos.' FROM '.$tabla.' WHERE '.$criterio.'='.$buscar;
              $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
              $datrol=mysqli_fetch_array($restrol);
              $descmat=$datrol;
              mysqli_free_result($restrol);
              //dd($descmat);
              return $datrol;
            }
            //CUENTAS POR PAGAR
            //$ccpp=traeresumen('proveedores.nombre, _ccompras.diferenciapago', '_ccompras INNER JOIN proveedores ON proveedores.cedula = _ccompras.cedula', 'idestatuspago', '2 GROUP BY _ccompras.id');
          @endphp{{-- INVENTARIO --}}
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
            <div class="card">
              <div class="card-header bg-warning" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Inventario&nbsp;
                {{-- <h2>{{ traesuma('SUM(totalcomra)', '_ccompras', 'idestatuspago', '2') }}</h2> --}} </label></h3>
              </div>
              <div class="card-body">
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Material</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($inventarios as $inventario)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td>
                    <td class="px-1 py-1">{{$inventario->descripcion}}</td>
                    <td class="px-1 py-1">{{$inventario->cantidad}}</td>
                    <td class="px-1 py-1">
                      <a href="" wire:click.prevent="edit({{ $inventario->id }})"><i class="fa fa-edit mr-2"></i></a>
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
              </div>
            </div>
          </div>{{-- CUENTAS POR PAGAR --}}
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
            <div class="card">
              <div class="card-header bg-danger" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Cuentas por Pagar&nbsp;
                <h2>{{ traesuma('SUM(totalcomra)', '_ccompras', 'idestatuspago', '2') }}</h2> </label></h3>
              </div>
              <div class="card-body">
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($ccpp as $cp)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td>
                    <td class="px-1 py-1">{{$cp->nombre}}</td>
                    <td class="px-1 py-1">{{$cp->diferenciapago}}</td>
                    <td class="px-1 py-1">
                      <a href="" wire:click.prevent="edit({{ $cp }})"><i class="fa fa-edit mr-2"></i></a>
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
              </div>
            </div>
          </div>{{-- CUENTAS POR COBRAR --}}
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
            <div class="card">
              <div class="card-header bg-info" {{-- @php echo $fondoo; @endphp --}}><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Cuentas por Cobrar&nbsp;
                <h2>{{ traesuma('SUM(totalcomra)', '_ccompras', 'idestatuspago', '2') }}</h2> </label></h3>
              </div>
              <div class="card-body">
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($ccpp as $cp)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$loop->iteration}}</td>
                    <td class="px-1 py-1">{{$cp->nombre}}</td>
                    <td class="px-1 py-1">{{$cp->diferenciapago}}</td>
                    <td class="px-1 py-1">
                      <a href="" wire:click.prevent="edit({{ $cp }})"><i class="fa fa-edit mr-2"></i></a>
                      {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $producto->id } }) --} }destroy({ { $producto->id } })"><i class="fa fa-trash text-danger"></i></a> --}}
                    </td></tr>
                  @endforeach</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </div>
</x-admin-layout>