@include('frontend.header')
<style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="welcome"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Checkout Page</li>
        </ol>
    </div>
</div>
<div class="register">
    <div class="container">
        <h3 class="animated wow zoomIn" data-wow-delay=".5s">Shipping Address</h3>
        <p class="est animated wow zoomIn" data-wow-delay=".5s">
        <form action="{{url('/order')}}" method="post">
            @csrf

            <div class="login-form-grids">
                <h5 class="animated wow slideInUp" data-wow-delay=".5s">Order Detail</h5>

                <input type="text" name="first_name" placeholder="First Name..." required=" " >
                <input type="text" name="last_name" placeholder="Last Name..." required=" " >
                <br>
                <input type="text" name="address" placeholder="Address..." required=" " >
                <br>
                <input type="text" name="city" placeholder="City..." required=" " >
                <br>
                <input type="text" name="state" placeholder="State..." required=" " >
                <br>
                <input type="text" name="country" placeholder="Country..." required=" " >
                <br>
                <input type="text" name="phone_no" placeholder="Phone Number..." required=" " >
                <br>
                <input type="text" name="pincode" placeholder="Pincode Number..." required=" " >
                <br>
              
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

                <!-- </div>
                <button type="{{url('/order-confirm')}}" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>

            </div>
        </form>

    </div>
</div> -->
@include('frontend.footer')