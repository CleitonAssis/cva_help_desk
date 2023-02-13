//Função transformar letras em minúsculas em tempo real no input
function minuscula(string){
  res = string.value.toLowerCase();
  string.value = res;
}

function alert() {
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
	    toast.addEventListener('mouseenter', Swal.stopTimer)
	    toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})

	Toast.fire({
	  icon: 'success',
	  title: 'Conexão com o banco de dados realizada com sucesso!'
	})
}
alert();
