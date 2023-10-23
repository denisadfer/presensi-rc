<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ed416eb336.js" crossorigin="anonymous"></script>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()

  $('[data-toggle="popover"]').click(function () {
    setTimeout(function () {
      $('.popover').popover('hide');
    }, 3000);
  });
})
</script>