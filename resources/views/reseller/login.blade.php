<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{asset('reseller/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('reseller/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">

    <script src="{{asset('reseller/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

    <title>Login || Reseller</title>
</head>
<body>
<div class="container mt-10">
    <div class="row justify-content-center">
        <div class="col-lg-5 login-heading">
            <h3>Welcome Back</h3>
            <p> Mohasagor <strong>Reseller</strong>, The best platform of the resell of product on mohasagor</p>
        </div>
        <div class="col-lg-4">
            <div class="login-form">
                <form id="loginForm" action="{{route('reseller.login')}}" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <li class="list-group-item list-group-item-warning">{{session()->get('error')}}</li>
                    @endif
                    @if(session()->has('message'))
                        <li class="list-group-item list-group-item-success">{{session()->get('message')}}</li>
                    @endif


                    @csrf
                    <div class="form-group">
                        <label>Reseller username</label>
                        <input type="text" class="form-control" name="username" id="userName" onkeyup="validation()"
                               value="{{old('username')}}">
                        <span class="text-red display-none" id="userNameMessage"></span>

                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               onkeyup="validation()">
                        <span class="text-red display-none" id="passwordMessage"></span>
                    </div>
                    <button class="btn btn-primary" disabled>LOGIN</button>
                </form>

                <div class="text-center mt-2">
                      <a href="#" id="forGetPassword" class="mt-2">Forget Password <strong class="text-black">||</strong></a>
                      <a href="{{route('reseller.register.display')}}"  class="mt-2 text-green">Register Here</a>
                  </div>
            </div>

        </div>
    </div>


    <!-- Reset Password Modal -->
    <div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog"
         aria-labelledby="forgetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgetPasswordModalLabel">Reset your password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgetPasswordForm" method="post" action="{{route('reseller.password.reset')}}">
                        @csrf
                        <h3 class="text-center mt-2 loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i>Loading
                        </h3>

                        <div class="form-group accountNumber">
                            <label>Account mobile number</label>
                            <input class="form-control" placeholder="01xxxxxxxxx" id="input" name="mobile" type="text">
                        </div>

                        <div class="form-group vCode" style="display: none;">
                            <label>Verification code</label>
                            <input class="form-control" placeholder="code"  name="verification_code" type="text">
                            <input name="reseller_id" value="0" type="hidden">
                        </div>


                        <div class="form-group newPassword" style="display: none;">
                            <label>New password</label>
                            <input class="form-control" placeholder="new password"  name="password" type="password">
                        </div>


                        <button class="btn btn-primary btn-block sendCode" disabled>Send Code</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        background: #F0F2F5;
    }

    .mt-10 {
        margin-top: 10rem;
    }

    .login-form {
        background: #fff;
        padding: 35px 22px;
        width: 400px;
        height: 350px;
        box-shadow: 8px 20px 10px 10px #ddd;
    }

    button.btn.btn-primary {
        width: 100%;
    }

    .login-heading {
        margin-top: 80px;
    }

    .login-heading strong {
        color: blue;
    }

    .display-none {
        display: none;
    }

    .text-red {
        color: red;
    }
    .text-green{
        color: green;
    }
    .text-black{
        color: black;
    }

    @media only screen and (max-width: 600px) {
        .mt-10 {
            margin-top: -32px;
        }

        .login-heading {
            text-align: center;
        }

        .login-heading p {
            font-size: 16px;
            text-align: center;
            margin-left: 15px !important;
        }

        .login-form {

            width: 350px;
            height: 300px;
            margin-bottom: 50px;
        }
    }
</style>
<script>
    function validation() {

        let name = $("#userName").val();
        let password = $("#password").val();

        let disable = true;


        //name field validation
        if (name.length == 0 || name == null || name == 'undefined') {
            $('#userNameMessage').show();
            $('#userNameMessage').text('user name field is required');
        }
        if (name.length > 0) {
            disable = false;
            $('#userNameMessage').hide();

        }


        //roll field validation

        if (password.length == 0 || password == null || password == 'undefined') {
            disable = true;
            $('#passwordMessage').show();
            $('#passwordMessage').text('password field is required');
        }
        if (password.length > 0) {
            $('#passwordMessage').hide();
            disable = false;

        }


        //if all validation data
        if (name.length > 0 && password.length > 0 && disable == false) {
            console.log(disable)
            $(".btn-primary").attr('disabled', false)
        } else {
            $(".btn-primary").attr('disabled', true)
        }


    }

    $("#forGetPassword").on('click', function (e) {
        $("#forgetPasswordModal").modal('show');
    })
    $("#input").on('keyup', function () {

        let value = $(this).val();
        if (value.length == 11) {
            $('.sendCode').attr('disabled', false)
        } else {
            $('.sendCode').attr('disabled', true)
        }

    });
    $('#forgetPasswordForm').on('submit', function (event) {
        event.preventDefault();
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData($(this)[0]);
        let vCodeAction='{{route('code.verification')}}'
        let newpassword='{{route('new.password.reset.reseller')}}'
        $.ajax({
            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.loading').show();

            },
            //success function
            success: function (resp) {
                console.log(resp)
                $('.loading').hide();
             if (resp.success == "OK") {

                 if (resp.status=='send'){

                     $("#forgetPasswordForm").attr('action',vCodeAction)
                     $("#forgetPasswordForm").find("input[name='reseller_id']").val(resp.reseller.id);
                     $("#forgetPasswordForm").find('.vCode').show();
                     $("#forgetPasswordForm").find('.accountNumber').hide();
                     $("#forgetPasswordForm").find('.newPassword').hide();
                     $("#forgetPasswordForm").find('.sendCode').text('Verify code');
                 }

                 if (resp.status=="code"){

                     $("#forgetPasswordForm").attr('action',newpassword)
                     $("#forgetPasswordForm").find("input[name='reseller_id']").val(resp.reseller.id);
                     $("#forgetPasswordForm").find('.vCode').hide();
                     $("#forgetPasswordForm").find('.newPassword').show();
                     $("#forgetPasswordForm").find('.accountNumber').hide();
                     $("#forgetPasswordForm").find('.sendCode').text('New password');
                 }
                 
                    if (resp.status=="change"){
                         $("#forgetPasswordModal").modal('hide');
                     }


                 Swal.fire({
                        type: 'success',
                        text: resp.message,
                    });


                } else {
                    Swal.fire({
                        type: 'error',
                        title: '<P style="color: red;">Oops...<p>',
                        text: resp.message,
                        footer: '<b> Something Wrong</b>'
                    });
                }
            },
            //error function
            error: function (e) {
                console.log(e)

                $('.loading').hide();
            }
        });
    });


</script>
@include('reseller.partials.js')
</body>
</html>
