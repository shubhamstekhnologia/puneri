@if (Session::has('AccessTokens'))
   <?php $value = Session::get('AccessTokens') ?>
@else
    <script>window.location.href = ''</script>
@endif 
@if($user_address->isNotEmpty())

    @foreach($user_address as $profile)

        @php

            $name = $profile->name;
            $mobile_no = $profile->mobile_no;
            $area = $profile->area;
            $city = $profile->city;
            $address_details = $profile->address_details;
            $address_type = $profile->address_type;
            $pincode = $profile->pincode;
            $state = $profile->state;
            $country = $profile->country;
            $id = $profile->id;
           
        @endphp

    @endforeach

@endif

@extends('templates.frontend.header')
@section('content')
 <section>
      <div class="container">
        <div class="row justify-content-md-center h-100">
          <div class="card-wrapper">
           
            <div class="card fat">
              <div class="card-body">
                       @include('templates.frontend.messages')
                <h3 class="card-title" style="margin:auto;">Update User Address</h3>
                      {!! Form::open(['method' => 'POST', 'url' => 'update-user-address', 'enctype' => 'multipart/form-data']) !!}
                      <input name="id" type="hidden" value="{{$id}}" />
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      name="name"
                      value="{{$name}}"
                      autofocus
                    />
                    <div class="invalid-feedback">What's your name?</div>
                  </div>

                  <div class="form-group">
                    <label for="number">Mobile Number</label>
                    <input
                      id="mobile_no"
                      type="number"
                      class="form-control"
                      name="mobile_no"
                      value="{{$mobile_no}}"
                     
                    />
                    <div class="invalid-feedback">Your mobile number</div>
                  </div>
                  <div class="form-group">
                    <label for="name">Area</label>
                    <input
                      id="area"
                      type="text"
                      class="form-control"
                      name="area"
                      value="{{$area}}"
                      autofocus
                    />
                    <div class="invalid-feedback">Area</div>
                  </div>
                  <div class="form-group">
                    <label for="name">City</label>
                    <input
                      id="city"
                      type="text"
                      class="form-control"
                      name="city"
                      value="{{$city}}"
                      autofocus
                    />
                    <div class="invalid-feedback">City</div>
                  </div>
                  <div class="form-group">
                    <label for="name">State</label>
                    <input
                      id="state"
                      type="text"
                      class="form-control"
                      name="state"
                      value="{{$state}}"
                      autofocus
                    />
                    <div class="invalid-feedback">State</div>
                  </div>
                  <div class="form-group">
                    <label for="name">Country</label>
                    <input
                      id="country"
                      type="text"
                      class="form-control"
                      name="country"
                      value="{{$country}}"
                      autofocus
                    />
                    <div class="invalid-feedback">Country</div>
                  </div>

                    <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input
                      id="pincode"
                      type="number"
                      class="form-control"
                       value="{{$pincode}}"
                      name="pincode"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">pincode is required</div>
                  </div>

                


                    <div class="form-group">
                    <label for="address">Address Details</label>
                    <input
                      id="address_details"
                      type="text"
                      class="form-control"
                      name="address_details"
                       value="{{$address_details}}"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">Address details is required</div>
                  </div>

                  <div class="form-group">
                    <label for="city">Address Type</label>
                
                    <label class="radio-inline">
                      <input type="radio" name="address_type" value="Home">&nbsp;Home
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="address_type" value="Office">&nbsp;Office
                    </label>
                    
                    <div class="invalid-feedback">Address Type is required</div>
                  </div>

               

                 

                

                  <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block">
                      Submit
                    </button>
                  </div>
                 
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>


@endsection

