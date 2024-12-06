@extends('templates.frontend.header')
@section('content')
  <div class="container">
      <div class="row">
          
          <div class="col-md-4"> </div>
        <div class="col-md-4" style="margin:100px 0px 50px 0px">
            <h2>Forgot  Password</h2>
              {!! Form::open(['method' => 'POST', 'url' => 'update-forgot-password', 'enctype' => 'multipart/form-data']) !!}
          <div class="card fat">
            <div class="card-body">
               @include('templates.frontend.messages')
              <label>Email ID</label>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email ID"/>
              </div>
              <div class="form-group m-0">
                <button type="submit" class="btn btn-primary btn-block">
                  Submit
                </button>
              </div>
            </div>
          </div>
       </form>
        </div>
      </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        $(".pass_show").append('<span class="ptxt">Show</span>');
      });

      $(document).on("click", ".pass_show .ptxt", function () {
        $(this).text($(this).text() == "Show" ? "Hide" : "Show");

        $(this)
          .prev()
          .attr("type", function (index, attr) {
            return attr == "password" ? "text" : "password";
          });
      });
    </script>


@endsection