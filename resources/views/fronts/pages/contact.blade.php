@extends('fronts.layouts.master')
@section('meta_tags')
        <title>{{$meta_tag->title}}</title>
        <meta name="description" content="{{$meta_tag->description}}">
        <meta name="keywords" content="{{$meta_tag->keywords}}">
        <link rel="author" href="https://plus.google.com/{{$meta_tag->googlePlusId}}" />
        <link rel="canonical" href="{{$meta_tag->pageUrl}}" />

        <meta property="og:url" content="{{$meta_tag->pageUrl}}">
        <meta property="og:image" content="{{$meta_tag->imageUrl}}">
        <meta property="og:description" content="{{$meta_tag->description}}">
        <meta property="og:title" content="{{$meta_tag->pageTitle}}">
        <meta property="og:site_name" content="{{$meta_tag->siteTitle}}">
        <meta property="og:see_also" content="{{$meta_tag->homepageUrl}}">

        <meta itemprop="name" content="{{$meta_tag->pageTitle}}">
        <meta itemprop="description" content="{{$meta_tag->description}}">
        <meta itemprop="image" content="{{$meta_tag->imageUrl}}">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" content="{{$meta_tag->pageUrl}}">
        <meta name="twitter:title" content="{{$meta_tag->pageTitle}}">
        <meta name="twitter:description" content="{{$meta_tag->description}}">
        <meta name="twitter:image" content="{{$meta_tag->imageUrl}}">
@endsection
@section('content')
  <!-- Masthead -->
  <!-- <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
          <div class="row">
              <div class="col-xl-9 mx-auto mt-5">
                  <h4>We are ready to help you</h4>
                  <br>
                  <h1 class="mb-5">Contact Us</h1>
                  <br>
                  <h3>Let us know your problems and we will work together to resolve it.</h3>
              </div>
              <div class="col-xl-12 mx-auto order-now my-padding">
                  <a class="btn btn-default btn-lg enrollbtn" href="{{route('blog')}}" style="border-radius:22.5px;font-weight:600;padding-left:40px;padding-right:40px">Read more!</a>
              </div>
          </div>
      </div>
  </header> -->
  <!-- Masthead Finish-->
  <!-- Masthead -->
  <style>
  header.masthead {
   position: relative;
   background-color: #343a40;
   height: 100vh;
   background: url({{asset('/assets/images/background/olimpo-avila-salazar-c9I-U1mPDyA-unsplash.jpg')}}) no-repeat fixed center center;
   -webkit-background-size: cover;
   -moz-background-size: cover;
   -o-background-size: cover;
   background-size: cover;
   padding-top: 8rem;
   padding-bottom: 8rem;
  }

  header.masthead .overlay {
   position: absolute;
   background-color: #212529;
   height: 100%;
   width: 100%;
   top: 0;
   left: 0;
   opacity: 0.3
  }

  header.masthead h1 {
   font-size: 2rem
  }

  @media (min-width:768px) {
   header.masthead {
       padding-top: 12rem;
       padding-bottom: 12rem
   }
   header.masthead h1 {
       font-size: 4rem;
   }
   header.masthead h3 {
       font-size: 1.5rem;
   }
  }

  .my-padding {
   padding-top: 4rem;
   padding-bottom: 8rem;
  }

  .form-row>.col,
  .form-row>[class*=col-] {
   padding-right: 0;
   padding-left: 0;
  }
  </style>
  <!-- Masthead -->

@include('fronts.inc.contact')

<!-- Masthead -->
<style>
  footer.masthead h1 {
   font-size: 2rem
  }

  @media (min-width:768px) {
   footer.masthead {
       padding-top: 1rem;
       padding-bottom: 4rem
   }
   footer.masthead h1 {
       font-size: 4rem;
   }
   footer.masthead h3 {
       font-size: 1.5rem;
   }
  }

  .my-padding {
   padding-top: 4rem;
   padding-bottom: 8rem;
  }

  .form-row>.col,
  .form-row>[class*=col-] {
   padding-right: 0;
   padding-left: 0;
  }
  </style>
  <!-- Masthead -->

 <!-- Masthead -->
 <!-- <header class="masthead2 text-left mainwrappad">
        <div class="overlay2"></div>
        <div class="container">
           <div class="row">
             <div class="col-md-12">
                <h1 style="color: #fff !important;font-weight:600;" align="center">Contact Info</h1>
                <p class="text-center w-75 m-auto" style="color:white;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris interdum purus at sem ornare sodales. Morbi leo nulla, pharetra vel felis nec, ullamcorper condimentum quam.</p>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-12 col-md-4 col-lg-4 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-phone fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">call us</h4>
                    <address>+0768408628</address>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-4 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-map-marker fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">office loaction</h4>
                   <address>Jaffna Town, Stanly Road, Peoples bank building, 2nd floor</address>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-4 col-lg-4 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-globe fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">email</h4>
                    <address>Thavarasanithi@gmail.com<address>
                  </div>
                </div>
             </div>
           </div>
        </div>
    </header> -->
    <!-- Masthead Finish-->
    <!-- Masthead -->
    <style>
    header.masthead2 {
     position: relative;
     background-color: #343a40;
     height: auto;
     background: url({{asset('assets/images/background/luis-quintero-aoz8a7jO0QI-unsplash.jpg')}}) no-repeat center center;
     -webkit-background-size: cover;
     -moz-background-size: cover;
     -o-background-size: cover;
     background-size: cover;
     width: 100%;
    }

    header.masthead2 .overlay2 {
     position: absolute;
     background-color: rgba(0, 0, 0);
     height: 100%;
     width: 100%;
     top: 0;
     left: 0;
     opacity: 0.8
    }

    .my-padding {
     padding-top: 4rem;
     padding-bottom: 8rem;
    }

    .form-row>.col,
    .form-row>[class*=col-] {
     padding-right: 0;
     padding-left: 0;
    }
    </style>
    <!-- Masthead -->
           
</div>
<!-- <div class="container-fluid" style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3933.1418936009527!2d80.01311708397378!3d9.668915188438344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afe540184d312e5%3A0xd2ee2d3f9c39fb4f!2sPeoples%20Bank%2C%20Stanley%20Rd%2C%20Jaffna!5e0!3m2!1sen!2slk!4v1595346661807!5m2!1sen!2slk" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div> -->

<style>
  .rajsha .card:hover i,.rajsha .card:hover h4 .card{
  color:  #f03271;
  }
</style>
@endsection

@section('js')
  <script type="text/javascript">
  $('#submit').click(function (e) {
      e.preventDefault();
      // Serialize the entire form:
      var formdata = new FormData(this.form);
      formdata.append('_token', "{{ csrf_token() }}"); 
      formdata.append('service_id', 'nithya');
      formdata.append('template_id', 'contact_template');
      formdata.append('user_id', 'user_tBr0fxRU5kusOaeiLyo8d');
      $.ajax('https://api.emailjs.com/api/v1.0/email/send-form', {
      type: 'POST',
      data: formdata,
      contentType: false, // auto-detection
      processData: false // no need to parse formData to string
      }).done(function() {
        toastr.success('sucess!', 'Your message has been recorded');
      }).fail(function(error) {
        toastr.error('oops!', 'Something went wrong');
      });
      $.ajax(
        {
        url: "{{ route('contact.store') }}",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        sucess: function (data)
        {
          
        },
        error: function (data) {
          
        }
      });
      $('#frm').trigger("reset");
  });
  </script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2.3.2/dist/email.min.js"></script>
<script type="text/javascript">
   (function(){
      emailjs.init("user_tBr0fxRU5kusOaeiLyo8d");
   })();
</script>

@endsection
