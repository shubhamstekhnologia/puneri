@if (Session::has('AccessTokens'))
   <?php $value = Session::get('AccessTokens') ?>
   @php 
   $user_name = Session::get('user_name');
   $user_no = Session::get("user_no");
   @endphp
@else
    <script>window.location.href = ''</script>
@endif 


@extends('templates.frontend.header')
@section('content')
 <section>
      <div class="container">
          <div class="my-5 address-fields shadow ">
              
      
          <div class="row">
              <div class="col-md-5">
                  <img src="{{asset('images/delivery.jpg')}}" class="h-100">
              </div>
              <div class="col-md-7 pr-3 pl-3 py-4">
                  @include('templates.frontend.messages')
                <h3 class="font-weight-bold pr-3 pl-3" style="margin:auto;">Add User Address</h3>
                      {!! Form::open(['method' => 'POST', 'url' => Session('main').'/user-address-save', 'enctype' => 'multipart/form-data']) !!}
                      <div class="row pr-3 pl-3">
                          
                     
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      name="name"
                      value="{{$user_name}}"
                      autofocus
                    />
                    <div class="invalid-feedback">What's your name?</div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="number">Mobile Number</label>
                    <input
                      id="mobile_no"
                      type="number"
                      class="form-control"
                      name="mobile_no"
                      value="{{$user_no}}"
                     
                    />
                    <div class="invalid-feedback">Your mobile number</div>
                     </div>
                  </div>
                  <div class="row pr-3 pl-3">
                      
                  
                
                    <div class="form-group col-md-6">
                    <label for="pincode">Pincode</label>
                    <input
                      id="zip"
                      type="number"
                      class="form-control"
                       value=""
                      name="pincode"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">pincode is required</div>
                    <div id="zip_error" style="display:none">pincode is required</div>
                  </div>
                  
                    <div class="form-group col-md-6">
                    <label for="name">Area</label>
                    <input
                      id="area"
                      type="text"
                      class="form-control"
                      name="area"
                      value=""
                      autofocus
                    />
                    <div class="invalid-feedback">Area</div>
                  </div>
                  </div>
                  <div class="row pr-3 pl-3">
                      
              
                  <div class="form-group col-md-6">
                    <label for="name">City</label>
                    <input
                      id="city"
                      type="text"
                      class="form-control"
                      name="city"
                      value=""
                      autofocus
                    />
                    <div class="invalid-feedback">City</div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">State</label>
                    <input
                      id="state"
                      type="text"
                      class="form-control"
                      name="state"
                      value=""
                      autofocus
                    />
                    <div class="invalid-feedback">State</div>
                  </div>
                      </div>
                      <div class="row pr-3 pl-3">
                          
                     
                  <div class="form-group col-md-6">
                    <label for="name">Country</label>
                    <input
                      id="country"
                      type="text"
                      class="form-control"
                      name="country"
                      value=""
                      autofocus
                    />
                    <div class="invalid-feedback">Country</div>
                  </div>


                    <div class="form-group col-md-6">
                    <label for="address">Address Details</label>
                    <input
                      id="address_details"
                      type="text"
                      class="form-control"
                      name="address_details"
                       value=""
                       placeholder="123 St, ABC Society"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">Address details is required</div>
                  </div>
                   </div>

             <div class="form-group pr-3 pl-3">
                    <label for="city">Address Type</label>
                
                    <label class="radio-inline px-2">
                      <input type="radio" name="address_type" value="Home" selected>&nbsp;Home
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="address_type" value="Office">&nbsp;Office
                    </label>
                    
                    <div class="invalid-feedback">Address Type is required</div>
                  </div>

               

                 

                

                  <div class="form-group m-0 pr-3 pl-3">
                    <button type="submit" class="btn btn-primary btn-block">
                      Submit
                    </button>
                  </div>
                 
                </form>
              </div>
          </div>

      </div>
      </div>
    </section>

<script>
 fetch("https://ipinfo.io/json?token=eb31ac8ed4275f").then(
  (response) => response.json()
).then(
  (jsonResponse) => console.log(jsonResponse.ip, jsonResponse.country)
)
</script>
@endsection

