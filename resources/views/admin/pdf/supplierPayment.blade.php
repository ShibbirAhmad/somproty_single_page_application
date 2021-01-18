<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body {
            margin-top: 20px;
        }
        table{
            text-align: center;

        }

        * {
            margin: 0;
            padding: 0;

        }

        .col-lg-6 {
            width: 40%;
        }

        table {
            border: 1px solid #000;
            padding: 10px 10px;
            /* background-image: url("https://i.stack.imgur.com/fNC36.png"); */

        }

        td,th {
            border: 1px solid #000;
            padding: 5px 5px;
            text-align: center;
        }
        .address {
            line-height: 0.4;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: bolder;

        }

        .p-h {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
        }

    </style>
</head>

<body>
 <div class="container">
        <div class="row">
            <div class="address">
                <p class="logo">Mohasagor.com</p>
                <p class="address_line">
                    Office: House:02, Lane:11,Block:A, Banarosi Polli, section-10,
                    Mirpur,Dhaka.
                </p>
                <p>Email: support@mohasagor.com</p>
                <p>Hot Line: <strong> 09636 203040</strong></p>

            </div>

            <div class="supplier">
                Supplier: <strong>{{ $supplier->company_name ?? $supplier->name }}</strong>
                <br />
                Supplier Phone: <strong>{{ $supplier->phone ?? '' }}</strong>
            </div>

            <div class="col-lg-6">
                <p class="p-h"> supplier payment report</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Paid By</th>
                            <th>Amount</th>
                            <th>Signature</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($total_paid_items as $k => $total_paid_item)


                            <tr>
                                <td>{{ $k + 1 }}</td>
                                <td>{{ date("d-m-Y", strtotime($total_paid_item->date))}}</td>
                                <td>{{ $total_paid_item->paid_by ?? '' }}</td>

                                <td>{{ $total_paid_item->amount }}</td>
                                <td></td>

                                </tr>
                        @endforeach

                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2"><strong> = {{ $total_paid_items->sum('amount') }}</strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>
