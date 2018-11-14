<script src="//code.jquery.com/jquery-2.0.2.min.js"></script>
<script src="<?= base_url("public/assets/js/stripe.js") ?>"></script>

<style type="text/css">
  .StripeElement {
    background-color: white;
    height: 40px;
    padding: 10px 12px;
    border-radius: 4px;
    border: 1px solid transparent;
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

<form action="" method="POST" id="payment-form">
  <span class="payment-errors"></span>
 
  <div class="row">
    <label>
      <span>Card Number</span>
      <input type="text" data-stripe="number">
    </label>
  </div>
 
  <div class="row">
    <label>
      <span>CVC</span>
      <input type="text" data-stripe="cvc">
    </label>
  </div>
 
  <div class="row">
    <label>
      <span>Expiration (MM/YYYY)</span>
      <input type="text" data-stripe="exp-month">
    </label>
    <input type="text" data-stripe="exp-year">
  </div>
 
  <button type="submit">Buy Now</button>
</form>

<script>
    jQuery(document).ready(function() {
        Stripe.setPublishableKey('pk_test_NKNegahMKyQOpa8Z3UfjDfpi');
        jQuery('#payment-form').on('submit', function(e) {
            e.preventDefault();
            var form = jQuery(this);
            form.find('button').prop('disabled', true);
            Stripe.createToken(form, stripeResponseHandler);
        });
        var stripeResponseHandler = function(status, response) {
            var form = jQuery('#payment-form');
            console.log( status );
            console.log( response );
            if (response.error) {
                form.find('.payment-errors').text(response.error.message);
                form.find('button').prop('disabled', false);
            } else {
                jQuery('<input>', {
                    'type': 'hidden',
                    'name': 'stripeToken',
                    'value': response.id
                }).appendTo(form);
                form.get(0).submit();
            }
        };
    });
</script>

<?php /*
<script type="text/javascript">
    var stripe = Stripe('pk_test_NKNegahMKyQOpa8Z3UfjDfpi');

    var elements = stripe.elements();

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
    var card = elements.create('card', {
        style: style, 
        hidePostalCode: true 
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
*/ ?>