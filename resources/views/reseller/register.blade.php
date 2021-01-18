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

    <title>Register || Reseller</title>
</head>
<body>
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-lg-5 login-heading">
            <h3>Register your account</h3>
            <p> Mohasagor <strong class="text-green">Reseller</strong>, The best platform of the resell of product on mohasagor</p>
        </div>
        <div class="col-lg-4">
            <div class="register-form">
                <form  action="{{route('reseller.register')}}" method="post">
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
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                               value="{{old('name')}}" placeholder="Ex:Mohamad" required>

                    </div>
                        <div class="form-group">
                            <label>Company or Facebook page name</label>
                            <input type="text" class="form-control" name="company_name"
                                   value="{{old('company_name')}}" placeholder="Ex:Mohasagor" required>

                        </div>



                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               value="{{old('email')}}" placeholder="youremail@mail.com" required>

                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone"
                               value="{{old('mobile')}}" placeholder="01xxx-xxxxxx" required>

                    </div>

                        <div class="form-group">
                            <label>Bkash_number</label>
                            <input type="text" class="form-control" name="bkash_number"
                                   value="{{old('bkash_number')}}" placeholder="01xxx-xxxxxx" required>

                        </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                               value="{{old('address')}}" placeholder="Mirpur-10, Dhaka-1216" required>

                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="password" required>
                    </div>
                    <button class="btn btn-success btn-block" >REGISTER</button>
                </form>
                <div class="text-center mt-2">
                    <a href="{{route('reseller.login')}}"  class="mt-2">Login Here</a>
                </div>

            </div>

        </div>
    </div>


    <!-- Reset Password Modal -->
</div>
<style>
    body {
        background: #F0F2F5;
    }


    .register-form {
        background: #fff;
        padding: 35px 22px;
        width: 400px;

        box-shadow: 8px 20px 10px 10px #ddd;
    }

    button.btn.btn-primary {
        width: 100%;
    }

    .login-heading {
        margin-top: 80px;
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
        .mt-2 {
            margin-top: 10px !important;
        }

        .login-heading {
            text-align: center;
        }

        .login-heading p {
            font-size: 16px;
            text-align: center;
            margin-left: 15px !important;
        }

        .register-form {

            width: 350px;

            margin-bottom: 50px;
        }
    }
</style>

@include('reseller.partials.js')
</body>
</html>
