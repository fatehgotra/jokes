 <script src="{{ asset('assets_admin/js/vendor.min.js1') }}"></script>
<script src="{{ asset('assets_admin/js/app.min.js1') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(".alert-dismissible").fadeTo(10000, 500).slideUp(500, function() {
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
    // $(function() {
    //     $('.selectpicker').selectpicker();
    // });
    $("button.searchToggle").click(function(){
        $(".searchBox").toggle();
    });
    $("button.closeSearch").click(function(){
        $(".searchBox").hide();
    });
    // $(document).ready(function(){
    //     $('#featured-slider').swiper({
    //         mode: 'horizontal',
    //         slidesPerView: 4,
    //         breakpoints: {
    //             900: {
    //                 slidesPerView: 2
    //             },
    //             640: {
    //                 slidesPerView: 1
    //             }
    //         },
    //         nextButton: '.swiper-button-next',
    //         prevButton: '.swiper-button-prev',
    //         loop: true,
    //         autoplay: 20000,
    //     });
    //     $('#just-slider').swiper({
    //         mode: 'horizontal',
    //         slidesPerView: 4,
    //         breakpoints: {
    //             900: {
    //                 slidesPerView: 2
    //             },
    //             640: {
    //                 slidesPerView: 1
    //             }
    //         },
    //         nextButton: '.swiper-button-next.next2',
    //         prevButton: '.swiper-button-prev.prev2',
    //         loop: true,
    //         autoplay: 20000,
    //     });
    // });

</script>

@stack('scripts')