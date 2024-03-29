<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_tags')
    <!-- Scripts -->
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <style>
    #myBtn {
            display: none; /* Hidden by default */
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            background-color: #261630; /* Set a background color */
            color: white; /* Text color */
            cursor: pointer; /* Add a mouse pointer on hover */
            padding: 15px; /* Some padding */
            border-radius: 10px; /* Rounded corners */
            font-size: 18px; /* Increase font size */
            text-decoration: none;
          }

    #myBtn:hover {
      background-color: #555; /* Add a dark-grey background on hover */
    }
    .search_result{
      position: absolute !important;
      margin-left: 555px;
      margin-top: 225px;
    }
    </style>
    @yield('extra_css')
    <link rel="shortcut icon" href="{{asset('assets/images/naq.jpg')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('assets/front/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/pricing.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
    <link href="{{asset('assets/plugins/toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
    @yield('style')
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XHQZFZR4CE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XHQZFZR4CE');
</script>
</head>
<body style="padding-bottom: 0px;padding-top:0px;">
  @include('fronts.inc.header')
  @yield('content')
  @include('fronts.inc.newfooter')
  <a data-scroll href="#scrolltops" id="myBtn"> <i class="fas fa-arrow-up"></i> </a>
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/popper.min.js')}}" charset="utf-8"></script>
  <script src="{{asset('assets/bootstrap.min.js')}}" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script type="text/javascript" src="{{asset('assets/front/js/owl-carousel.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/front/js/nav.js')}}"></script>
  <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
  <script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js" integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw==" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
  <script type="text/javascript">
  //Get the button:
  mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }
  </script>
   <script type="text/javascript">
           var scroll = new SmoothScroll('a[href*="#"]');
   </script>
  @yield('script')
  @include('fronts.inc.toastr')
  @yield('js')
  <script>
    $("#my-form").submit(function(e) {
        e.preventDefault();
        // Serialize the form data
        var formData = $(this).serialize();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '{{route('subscribe')}}',
            method: "POST",
            data: formData,
            success: function(response) {
                // Handle the successful response
                console.log(response);
                toastr.success('Subscribed successfuly');
                document.getElementById("my-form").reset();
            },
            error: function(xhr, status, error) {
                // Handle the error response
                toastr.error(xhr.responseText);
            }
        })
    })

    function searchBlog(){
    const searchValue = $('#search').val();
    $.ajax({
        url: '{{asset('/postsearch/?q=')}}' + searchValue,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            $('#searchResults').html('')
            console.log(res.length);
            if(res && res.length > 0){
                $('#searchBox').css('display', 'block');
            }
            else{
                $('#searchBox').css('display', 'none');
            }
            $.each(res, function(i, post) {
                    $('#searchResults').append('<a href="/blog/'+post.slug+'"><li>' + post.title + '</li></a>');
            });
        }
    })
    // Close search results box on click outside
    $(document).on('click', function(e) {
        const searchBox = $('#searchBox');
        if (!searchBox.is(e.target) && searchBox.has(e.target).length === 0) {
            searchBox.css('display', 'none');
        }
    });
}
  </script>
  <script type="text/javascript">
  window.client_website_id = "bb919844-5411-4019-be68-8d4e573185d5";
  (function(){d=document;s=d.createElement("script");s.src="http://localhost:8000/widget.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
  </script>
  <!-- <script type="text/javascript">(function(){d=document;s=d.createElement("script");s.src="https://sitegpt.ai/widget/387085529145934413.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script> -->
</body>
</html>
