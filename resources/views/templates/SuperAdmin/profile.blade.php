@if (Session::has('AccessToken'))

   <?php $value = Session::get('AccessToken') ?>

@else

    <script>window.location.href = "SuperAdmin";</script>

@endif

@extends('templates.SuperAdmin.layout')

@section('content')



@if(!empty($profile))

    @foreach($profile as $profile)

        <?php   

               $name = $profile->name;

               $email = $profile->email;

               $contact = $profile->contact;

               $username = $profile->admin_username;

        ?>

    @endforeach

@endif

<div class="content mt-3">

    <div class="animated fadeIn">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <strong class="card-title">Profile</strong>

                    </div>

                    <div class="card-body">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header"><strong>Your Profile</strong></div>

                                    <div class="card-body card-block"> 

                                        {!! Form::open(['method' => 'POST', 'url' => '']) !!}



                                            <div class="form-group">

                                                <label for="vat" class=" form-control-label">Name</label> 

                                               <input type="text" id="name" placeholder="Enter Name" class="form-control" value="{{$name}}" name="name" readonly="">

                                                <small class="text-danger">{{ $errors->first('name') }}</small>

                                            </div>



                                            <div class="form-group">

                                                <label for="vat" class=" form-control-label">Username</label> 

                                               <input type="text" id="username" placeholder="Enter Username" class="form-control" value="{{$username}}" name="username" readonly="">

                                                <small class="text-danger">{{ $errors->first('username') }}</small>

                                            </div>



                                            <div class="form-group">

                                                <label for="company" class=" form-control-label">Email ID</label>

                                                <input type="text" id="company" placeholder="Enter Email-Id" class="form-control" value="{{$email}}" name="email" readonly="">

                                                <small class="text-danger">{{ $errors->first('email') }}</small>

                                            </div>



                                            <div class="form-group">

                                                <label for="company" class=" form-control-label">Contact</label>

                                                <input type="text" id="company" placeholder="Enter Contact" class="form-control" value="{{$contact}}" name="contact" readonly="">

                                                <small class="text-danger">{{ $errors->first('contact') }}</small>

                                            </div>



                                          

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div><!-- .animated -->

</div><!-- .content -->

@endsection