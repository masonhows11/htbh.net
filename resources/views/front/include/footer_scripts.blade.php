<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/ijaboCropTool.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.alert-success').fadeIn().delay(4000).fadeOut();
    });
    $(document).ready(function () {
        $('.alert-warning').fadeIn().delay(4000).fadeOut();
    });
</script>
@yield('custom_script')
</body>
</html>
