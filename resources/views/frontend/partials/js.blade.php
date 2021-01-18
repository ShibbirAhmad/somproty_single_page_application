{{-- <script type="text/javascript" src="{{ asset('frontend/js/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.easing-1.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.dcjqaccordion.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script> --}}



<script>
    
    // console.log("contributed fahim muntasir");
    // console.log("contributed shibbir ahmad ");

    let clickMenu=document.getElementById('toggle-menu');
    let main_menu=document.getElementById("menu-list");
    clickMenu.addEventListener('click',function(){
        console.log('hello')
        console.log(main_menu)
        main_menu.classList.toggle('collapse-manu')
    })


    let cartClick=document.getElementById('cart-open');
    window.Image="";

    window.link=[];

    @if(session()->has('admin'))
        window.link =   {!! json_encode("App\Models\Admin::adminPermission()", true) !!};
        @else
         window.link =   {!! json_encode("App\Models\Admin::adminPermission()", true) !!};
    @endif

    

    
   
    //console.log(Image)
//   window.onscroll = function() {setStickyOnNavbar()};

// var navbar = document.getElementById("navbar");
// var sticky = navbar.offsetTop;

// function setStickyOnNavbar() {
//   if (window.pageYOffset >= sticky) {
//     navbar.classList.add("sticky")
//   } else {
//     navbar.classList.remove("sticky");
//   }
// }
</script>

<style>
    .sub_active {
        display: block !important;
    }

</style>
