<div class="pt-1">
  
  <div x-data="calcpeso()">
    <p x-text="textopn"></p>
    <input type="text" x-model="textopn" style="color: red; border: 1px; with: 100px;">
  </div>

  <div x-data="objpersona()">
    <div>El Nombre ingresado es:
      <label x-text="persona.nombre"></label>
      <label x-text="persona.apellido"></label></div>
    <div>Ingrese el Nombre
    <input type="text" x-model="persona.nombre"></div>
    <div>Ingrese el Apellido
    <input type="text" x-model="persona.apellido"></div>
    <div><button x-click="enviarDatos()">Enviar datos</button></div>
  </div>

  <div x-data="pdisponible()">
    <p x-text="texto"></p>
    <input type="text" x-on:input="onInput(event)">
    <input type="text" id="disponible" value="90" style="color: red; border: 0px; with: 100px;" disabled>
    <input type="text" x-model="disponible" style="color: red; border: 0px; with: 100px;" disabled>
    <button x-on:click="visible = !visible" x-show="visible" style="background-color: red;">GUARDAR</button>
  </div>

  <script>
    function pdisponible(){
      return { texto: '', visible: true,
        onInput: function(event){
          if(parseFloat(event.target.value) > parseFloat(disponible.value)){
            this.texto = "ES MAYOR"; 
            visible = false;
          }else{ 
            v = parseFloat(disponible.value) - parseFloat(event.target.value);
            if(isNaN(v)){
              this.texto = disponible.value;
            }else{ 
              this.texto = v; visible = true; 
            }
          }
        },
        onClick: function(){
          disponible.value = this.texto;
        }    
      }
    }

    function calcpeso() {
      return {
        textopn: ''
      }
    }

    function objpersona() {
      return {
        persona: {},
        enviarDatos: function () {
          console.log(this.persona);
        }
      }
    }
    
  </script>
</div>
