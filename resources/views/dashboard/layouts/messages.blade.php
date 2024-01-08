<script>
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
</script>
@if (Session::has('success'))
<script>
	$(function() {
		Toast.fire({
			icon: 'success',
			title: '{{ Session::get('success') }}'
		})

	});
</script>

@endif


@if (Session::has('error'))
<script>
	$(function() {
		Toast.fire({
			icon: 'error',
			title: '{{ Session::get('error') }}'
		})
	});
</script>
@endif