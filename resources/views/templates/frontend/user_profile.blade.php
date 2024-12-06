@if (Session::has('AccessTokens'))
   <?php $value = Session::get('AccessTokens') ?>
@else
    <script>window.location.href = ''</script>
@endif 
@if($profiles->isNotEmpty())

    @foreach($profiles as $profile)

        @php

            $name = $profile->name;
            $email = $profile->email_id;
            $contact = $profile->mobile_number;
            $address = $profile->address;
            $city = $profile->city;
            $pincode = $profile->pincode;
           
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
                <h3 class="card-title" style="margin:auto;">Profile User</h3>
                      {!! Form::open(['method' => 'POST', 'url' => 'update-profile', 'enctype' => 'multipart/form-data']) !!}
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
                      id="contact"
                      type="number"
                      class="form-control"
                      name="contact"
                      value="{{$contact}}"
                     
                    />
                    <div class="invalid-feedback">Your number is invalid</div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      name="email"
                      value="{{$email}}"
                      data-eye
                    />
                    <div class="invalid-feedback">Email is required</div>
                  </div>

                

                  <h3 style="margin:auto;">Address Details</h3>

                    <div class="form-group">
                    <label for="address">Address</label>
                    <input
                      id="address"
                      type="text"
                      class="form-control"
                      name="address"
                       value="{{$address}}"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">address is required</div>
                  </div>

                  <div class="form-group">
                    <label for="city">City</label>
                    <input
                      id="city"
                      type="text"
                      class="form-control"
                      name="city"
                       value="{{$city}}"
                      required
                      data-eye
                    />
                    <div class="invalid-feedback">city is required</div>
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

