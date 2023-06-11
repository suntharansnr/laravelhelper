<table class="table table-striped table-bordered table-responsive" id="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th>{{$theme->id}}</th>
        </tr>
    </thead>

    <tbody>
      <tr>
          <th scope="row">Logo</th>
          <td><img src="{{asset("$theme->logo")}}" alt="" style="width:150px !important;height:100px !important;"></td>
      </tr>
      <tr>
          <th scope="row">Welcome banner</th>
          <td><img src="{{asset("$theme->welcome_banner")}}" alt="" style="width:150px !important;height:100px !important;"></td>
      </tr>
      <tr>
          <th scope="row">Additional css</th>
          <td>{{$theme->additional_css}}</td>
      </tr>
      <tr>
          <th scope="row">Additional js</th>
          <td>{{$theme->additional_js}}</td>
      </tr>
      <tr>
          <th scope="col" width="25%">Google map embedded code</th>
          <td width="75%">{{$theme->Google_map_embedded_code}}</td>
      </tr>
      <tr>
          <th scope="col">Phone number</th>
          <td>{{ $theme->Phone_number }}</td>
      </tr>
      <tr>
          <th scope="col">Email address</th>
          <td>{{$theme->email_address}}</td>
      </tr>
      <tr>
          <th scope="col">Company name</th>
          <td>{{$theme->company_name}}</td>
      </tr>
      <tr>
          <th scope="col">Footer left text</th>
          <td>{{$theme->footer_left_text}}</td>
      </tr>
      <tr>
          <th scope="col">Footer right text</th>
          <td>{{$theme->footer_right_text}}</td>
      </tr>
      <tr>
          <th scope="col">Footer address</th>
          <td>{{$theme->Footer_address}}</td>
      </tr>
      <tr>
          <th scope="col">Footer about us</th>
          <td>{{$theme->footer_about_us}}</td>
      </tr>
    </tbody>
</table>
