@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','Manage subscription')
@section('contents')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 100px; margin-top: 60px;">
            <div class="col-md-8" style="padding: 0px 50px 10px 50px; background-color: #FAFAFB;">
                <div class="card">

                    <h3 class="mb-4 mt-4 justify-content-center" style="text-align: center;">Manage your subscription
                        plan</h3>
                    @if (Session::has('success'))
                        <div class="container alert-container">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <span><strong>Success</strong> {{ Session::get('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="container alert-container">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <strong>Whoops!</strong> There were some problems.<br>
                                @if (is_array(Session::get('error')))
                                    <span>{{ implode(' ', Session::get('error')) }}</span>
                                @else
                                    <span>{{ Session::get('error') }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cards)
                        <table class="col-md-8 table">
                            <tr>
                                <td>Credit Card</td>
                                <td>:</td>
                                <td>**** **** ***** {{$cards->last4}}</td>
                            </tr>
                            <tr>
                                <td>Expire Date</td>
                                <td>:</td>
                                <td>{{$cards->exp_month}} / {{$cards->exp_year}}</td>
                            </tr>
                            <tr>
                                <td>Subscription Valid Until</td>
                                <td>:</td>
                                <td>{{$endDate}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    @if($status==0)
                                        <span class="badge badge-success">Active</span>
                                    @elseif($status==1)
                                        <span class="badge badge-danger">Cancelled</span>
                                    @elseif($status==2)
                                        <span class="badge badge-danger">Expired</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                    <div class="card-body justify-content-center" style="text-align: center;">
                        <div class="stripe-card">
                            <div class="card">
                                @if($status!=2)
                                    <form action="{{ route('subscription.update') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="card-header">
                                                <label for="card-element">
                                                    If you want to change credit card ,
                                                    Enter your new credit card information
                                                </label>
                                            </div>
                                            <div class="card-body">
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                                <input type="hidden" name="plan" value="{{ $plan->id }}"/>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-dark" type="submit">Save Card</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('subscription.new') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="card-header">
                                                <label for="card-element" class="text-primary">
                                                    Your old subscription plan has been expired.For new subscription
                                                    plan please enter your new credit card information
                                                </label>
                                            </div>
                                            <div class="card-body">
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                                <input type="hidden" name="plan" value="{{ $plan->id }}"/>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-dark" type="submit">Pay</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <br>
                        @if($status==0)
                            <div class="col-md-12 mt-5">
                                <a href="{{ route('subscription.confirm') }}">Cancel Membership</a>
                            </div>
                        @elseif($status==1)
                            <div class="col-md-12 mt-5">
                                <a href="{{ route('subscription.resume') }}">Resume Membership</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .promo-banner-dummy-text {
            height: 19px;
            color: #000;
            /* font-family: Montserrat;	 */
            font-size: 16px;
            letter-spacing: 0.19px;
            line-height: 19px;
            text-align: center;
            margin-top: 40px;
        }

        .card {
            background-color: #FAFAFB;
            border: none;
            /* box-shadow: 0 2px 3px 0 rgba(0,0,0,0.1); */
        }

        .promo-banner {
            height: 158px;
            border: 1px solid #979797;
            background-color: #D8D8D8;
        }

        .you-will-not-be-charge {
            height: 38px;
            color: #1B2031;
            /* font-family: Montserrat;	 */
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 0.19px;
            line-height: 19px;
            text-align: center;
        }

        .you-can-cancel {
            height: 54px;
            color: #000;
            /* font-family: Montserrat;	 */
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.17px;
            line-height: 18px;
            text-align: center;
        }

        .set-up-your-credit-card {
            height: 22px;
            color: #000;
            /* font-family: Montserrat;	 */
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 0.22px;
            line-height: 22px;
            text-align: center;
        }

        .stripe-card {
            height: 218px;
            border: 1px solid #979797;
            background-color: #CCCCCC;
        }

        .start-btn {
            height: 53px;
            width: 290px;
            border: 1px solid #61A150;
            border-radius: 4px;
            background-color: #5ABF5A;
        }

        .h-100 {
            height: auto !important;
        }

        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
