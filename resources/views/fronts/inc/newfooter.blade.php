<section id="footer">
    <div class="container-fluid mainwrappad">
    <!-- <hr class="hr-foot"> -->
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12">
          <a class="ml-0" href="#" style="padding:0px"> <img class="ml-0" src="{{asset($theme->logo)}}" alt="" class="img-fluid"> </a>
          <p class="text-white">{{$theme->footer_about_us}} <span class="badge badge-info">  <a href="{{route('about')}}" style="text-decoration:none;color:white">Read more</a></span> </p>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-12">
          <h1 style="border-bottom:2px solid #415D78;padding-bottom:10px;font-weight:600;color:#fff">Links</h1>
          <p><a href="{{route('about')}}" style="text-decoration:none !important;color:#fff">About us</a></p>
          <p><a href="{{route('contact')}}" style="text-decoration:none !important;color:#fff">Contact us</a></p>
          <p><a href="{{route('faq')}}" style="text-decoration:none !important;color:#fff">Faq</a></p>
          <p><a href="{{route('blog')}}" style="text-decoration:none !important;color:#fff">Blog</a></p>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-12">
          <h1 style="border-bottom:2px solid #415D78;padding-bottom:10px;font-weight:600;color:#fff">Contact</h1>
          <p class="text-white"><i class="fas fa-phone-square"></i> {{$theme->Phone_number}}</p>
          <p class="text-white"><i class="fas fa-envelope"></i> {{$theme->email_address}}</p>
          <p class="text-white"><i class="fas fa-home"></i> {{$theme->Footer_address}}</p>
          <p class="text-white"><i class="fas fa-building"></i> {{$theme->company_name}}</p>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-12">
          <h1 style="border-bottom:2px solid #415D78;padding-bottom:10px;font-weight:600;color:#fff">Follow Us On</h1>
          <p> <a href="{{$social[0]->value}}" style="text-decoration:none !important;color:#fff !important"><i class="fab fa-facebook"></i> Facebook</a></p>
          <p> <a href="{{$social[1]->value}}" style="text-decoration:none !important;color:#fff !important"><i class="fab fa-linkedin"></i> Linkedin</a></p>
          <p> <a href="{{$social[2]->value}}" style="text-decoration:none !important;color:#fff !important"><i class="fab fa-twitter"></i> Twitter</a></p>
          <p> <a href="{{$social[3]->value}}" style="text-decoration:none !important;color:#fff !important"><i class="fab fa-youtube"></i> Youtube</a></p>
        </div>
      </div>
      <div class="d-none d-lg-block">
           <div class="row">
              <div class="col-md-6">
                 <p class="copyright float-left  text-white">{{$theme->footer_left_text}}</p>
              </div>
              <div class="col-md-6">
                 <p class="copyright float-right  text-white">{!! $theme->footer_right_text !!}</p>
              </div>
           </div>
      </div>
    </div>

    <div class="container-fluid d-lg-none" style="background-color:#261630;color:white !important;padding-top:10px;padding-bottom:10px;border-top:2px solid #fff;padding-left:6% !important;padding-right:6%">
            <p class="text-white">{{$theme->footer_left_text}}</p>
            <p class="text-white">{!! $theme->footer_right_text !!}</p>
    </div>

  </section>
  <style>
     .hr-foot{
         border-color:white !important;
     }
     #footer
     {
       margin-top: 0px;
       padding-top: 20px;
       background-color: #261630;
       color: white;
     }
     .footer-logo
     {
       width: 150px;
       margin-top: 25px;
       margin-bottom: 15px;
     }
     #footer h1
     {
       font-size: 20px;
       text-align: left;
       margin-top: 25px;
       margin-bottom: 25px;
     }
     #footer p{
       font-size: 14px;
       text-align: left;
       font-weight: 600;
       color: #261630;
     }
     
     #footer .city{
       margin-left: 37px;
     }
     #footer .row .fa{
       padding-right: 20px;
       font-size:15px;
     }
     #footer hr{
       margin-bottom: 80px;
     }
     #footer .fa-heart-o{
       color: red;
       font-size: 17px;
     }

  </style>