<script>
  function main(){
    return { open: false, vpeso: false
      /* cambio: function (event) {
        //open: false, vpeso: false
        this.close = false;
        if(close == true){ 
          this.close = false;
        }
      } */
    }
  }
</script>
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $('.formulario-eliminar').submit(function(e){
    e.preventDefault();
    Swal.fire({
    title: 'Atención',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '¿Realmente quiere eliminar el producto?'
    }).then((result) => {
      if (result.value) {
      /* if (result.isConfirmed) { */
        /* Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        ) */
        this.submit();
      }
    })
  });
</script>
@endsection