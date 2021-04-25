<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
    <div class="card-header"><h3 class="card-title">CONFIGURACIONES GENERALES</h3></div>
      <div class="container-fluid">
        <div class="row aling: center">{{-- INICIO CLAVE MAESTRA --}}
          <div class="col-lg-3 col-md-2 col-xs-2 mt-2">
            <div class="card">
              <div class="card-header" @php echo $fondoo; @endphp>
                <h3 class="card-title" style="color: #fff; margin-right: 2px;">
                  <label class="d-flex justify-content-center">Clave Maestra</label></h3>
              </div>
              <div class="card-body">
                <div class="form-group" style="display: flex; flex-wrap: wrap; text-align: center; margin-right: 2px; width: 100%;">
                  @if ($this->cambiarclave=="SI")  
                    <label for="claveactual" style="width: 100%">Clave Actual{{-- <label> --}}
                      <input wire:model="claveactual" style="width: 100%; text-align: center;" id="claveactual" type="password" placeholder="Ingrese la Nueva Clave Maestra" 
                      maxlength="8" name="claveactual">
                    @error('claveactual')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                    <label for="nuevaclave" style="width: 100%">Nueva Clave{{-- <label> --}}
                      <input wire:model="nuevaclave" style="width: 100%; text-align: center;" id="nuevaclave" type="password" placeholder="Ingrese la Nueva Clave Maestra" maxlength="8" name="nuevaclave">
                    @error('nuevaclave')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror</label>                    
                  @endif
                  @if ($this->cambiarclave=="NO")
                    <button wire:click="deseacambiar" class="btn btn-primary mt-2 mr-2" style="width: 100%;"><i class="fa fa-save mr-1"></i>CAMBIAR CLAVE</button>
                  @else
                    <button wire:click="cancelar" class="btn btn-secondary mt-2 mr-2" style="width: 48%;"><i class="fa fa-times mr-1"></i>NO Cancelar</button>  
                    <button wire:click="cambiar" class="btn btn-primary mt-2 formulario-cambiarclave" style="width: 48%;"><i class="fa fa-save mr-1"></i>SI Cambiar</button>
                  @endif
                  </div>
                </div>
              </div>
            </div>
          </div>{{-- INICIO PRECIOS PROVEEDORES --}}
          <div class="col-lg-12 col-md-4 col-xs-4 mt-4">
            <div class="card">
              <div class="card-header" @php echo $fondoo; @endphp>
                <h3 class="card-title" style="color: #fff; margin-right: 2px;">
                  <label class="d-flex justify-content-center">Precios de Proveedores</label></h3>
              </div>
              <div class="card-body">
                <div class="form-group" style="display: flex; flex-wrap: wrap; text-align: center; margin-right: 2px; width: 100%;">
                    <div style="width: 100%; margin-right: 2px;"><label for="cedulaproveedorprecios" style="width: 100%; margin-right: 2px;">Seleccione el Proveedor</label>
                      <select name="cedulaproveedorprecios" wire:model="cedulaproveedorprecios" id="cedulaproveedorprecios" style="width: 100%; text-transform: uppercase;" wire:onchange="cambioidcpc({{$this->cedulaproveedorprecios}})">
                        <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor->cedula}}" style="width: 100%;">
                                {{$proveedor->cedula." ".$proveedor->nombre}}
                            </option>
                        @endforeach
                      </select>@error('cedulaproveedorprecios')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </div>
                    @if (is_null($this->cedulaproveedorprecios)!="true" or $this->cedulaproveedorprecios>1)
                      <label for="claveactual" style="width: 100%">Lista de Precios</label>
                      @if(session('cedulaactual')!=$this->cedulaproveedorprecios)
                          @php session(['cedulaactual' => $this->cedulaproveedorprecios]); @endphp
                      @endif
                      @foreach ($productos as $producto)
                        @if ($producto->id>1)
                            @php
                                 if(session('cedulaactual')!=$this->cedulaproveedorprecios){
                                    $this->{"p".$producto->id}=$this->traeprecio($this->cedulaproveedorprecios, $producto->id);
                                 } 
                            @endphp
                            <div style="width: 90px; text-align: center; margin-right: 3px;">
                            <label style="width: 100%;">{{$producto->descripcion}}</label>
                            <label style="width: 100%;">{{$this->traeprecio($this->cedulaproveedorprecios, $producto->id)}}$</label>
                                <input type="text" wire:model="p{{$producto->id}}"
                                id="p{{$producto->id}}" name="p{{$producto->id}}" placeholder="Ingresar" size="9" maxlength="9" min="0" max="99999999999" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%; /* border-color: white white green white; */ font-weight:900; color:red; padding-top: 0px;"
                                value="{{$this->traeprecio($this->cedulaproveedorprecios, $producto->id)}}">
                            </div>
                        @endif
                      @endforeach
                      <button wire:click="cancelarcambiarprecios" class="btn btn-secondary mt-2 mr-2" style="width: 20%;"><i class="fa fa-save mr-1"></i>Cancelar</button>
                      <button wire:click="cambiarprecios" class="btn btn-primary mt-2 formulario-cambiarprecio" style="width: 20%;"><i class="fa fa-save mr-1"></i>Cambiar Precios</button>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>{{-- FIN LIQUIDEZ --}}
        </div>
      </div>
    </div>
    @if (session('confirmacambioclavemaestra') == 'SI') {{-- MENSAJE SE CAMBIO LA CLAVE MAESTRA --}}
        <script>
            Swal.fire(
                'ATENCION!',
                'La Clave Maestra se ha cambiado.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-cambiarclave').submit(function(e){
            e.preventDefault();
            Swal.fire({
              title: 'Are you sure?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, quiero cambiarla'
            }).then((result) => {
              if (result.isConfirmed) {
                
              }
            })
        })
    </script>
</div>
@section('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection