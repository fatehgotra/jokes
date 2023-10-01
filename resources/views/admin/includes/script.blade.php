<script src="{{ asset('assets_admin/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/app.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(".alert-dismissible").fadeTo(6000, 500).slideUp(500, function() {
        $(".alert-dismissible").slideUp(500);
    });
</script>
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
@stack('scripts')
<!-- demo app -->
{{-- <script src="{{ asset('assets_admin/js/pages/demo.dashboard.js') }}"></script> --}}
