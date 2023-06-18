<section id="footer">
  <div class="container-fluid pt-2 pb-2">
      <p class="text-white">{{$theme->footer_left_text}}</p>
  </div>
  <div class="container-fluid">
    <form id="my-form">
      <div class="row justify-content-center no-gutters">
        <div class="col-md-3">
          <div class="form-group">
            <input type="email" class="form-control rounded-0" name="email" required>
          </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-block rounded-0">Submit</button>
        </div>
    </form>
    </div>
  </div>
</section>
<style>
  .hr-foot {
    border-color: white !important;
  }

  #footer {
    margin-top: 0px;
    padding-top: 20px;
    background-color: #261630;
    color: white;
  }

  .footer-logo {
    width: 150px;
    margin-top: 25px;
    margin-bottom: 15px;
  }

  #footer h1 {
    font-size: 20px;
    text-align: left;
    margin-top: 25px;
    margin-bottom: 25px;
  }

  #footer p {
    font-size: 14px;
    text-align: center;
    font-weight: 600;
    color: #261630;
  }

  #footer .city {
    margin-left: 37px;
  }

  #footer .row .fa {
    padding-right: 20px;
    font-size: 15px;
  }

  #footer hr {
    margin-bottom: 80px;
  }

  #footer .fa-heart-o {
    color: red;
    font-size: 17px;
  }
</style>