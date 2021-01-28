<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function() {

        console.log("{{ env('STRIPE_PUBLISH_KEY') }}")

        console.log("eliteaa:", "<?php echo env('STRIPE_PUBLISH_KEY'); ?>")
        // Create an instance of the Stripe object
        // Set your publishable API key
        var stripe = Stripe("{{ env('STRIPE_PUBLISH_KEY') }}");

        // Create an instance of elements
        // var elements = stripe.elements();

        // console.log(elements)
        // var style = {
        //     base: {
        //         fontWeight: 400,
        //         fontFamily: '"DM Sans", Roboto, Open Sans, Segoe UI, sans-serif',
        //         fontSize: '16px',
        //         lineHeight: '1.4',
        //         color: '#1b1642',
        //         padding: '.75rem 1.25rem',
        //         '::placeholder': {
        //             color: '#ccc',
        //         },
        //     },
        //     invalid: {
        //         color: '#dc3545',
        //     }
        // };

        // var cardElement = elements.create('cardNumber', {
        //     style: style
        // });
        // cardElement.mount('#card_number');

        // var exp = elements.create('cardExpiry', {
        //     'style': style
        // });
        // exp.mount('#card_expiry');

        // var cvc = elements.create('cardCvc', {
        //     'style': style
        // });
        // cvc.mount('#card_cvc');

        // // Validate input of the card elements+++++++++++++++++++++++
        // var resultContainer = document.getElementById('paymentResponse');
        // cardElement.addEventListener('change', function (event) {
        //     if (event.error) {
        //         resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
        //     } else {
        //         resultContainer.innerHTML = '';
        //     }
        // });





        var elements = stripe.elements();

        var style = {
        base: {
            color: "#32325d",
            fontFamily: 'Arial, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
            color: "#32325d"
            }
        },
        invalid: {
            fontFamily: 'Arial, sans-serif',
            color: "#fa755a",
            iconColor: "#fa755a"
        }
        };

        var card = elements.create("card", { style: style });
        // Stripe injects an iframe into the DOM
        card.mount("#card-element");

        card.on("change", function (event) {
        // Disable the Pay button if there are no card details in the Element
        // document.querySelector("button").disabled = event.empty;
        document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
        });


        // Get payment form element
        var form = document.getElementById('payment-form');

        // Create a token when the form is submitted.
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            createToken();
        });

        // Create single-use token to charge the user
        function createToken() {
            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error
                    resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        }

        // Callback to handle the response from stripe
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
        
        $("#btn_register").click(function(){
            

            if($("#email").val()==""){
                $("#email-error").html('The terms conditions must be accepted.');
                return false;
            }else{
                $("#email-error").html('');
            }

            if(!$('#terms_conditions').prop('checked')){
                $("#terms-error").html('The terms conditions must be accepted.');
                return false;
            }else{
                $("#terms-error").html('');
            }

            // var email = $("#email").val()

            // $("#verify_email").val(email)

            // console.log("this is my value:", $("#verify_email").val())
            // $("#email_form").submit()

            // $.ajax({
            //         url: "{{ route('email.verify') }}",
            //         type: 'POST',
            //         data: { '_token': '{{ csrf_token() }}', 'email': email },
            //         dataType: 'json',
            //         success: function(user_info) {
            //             console.log(user_info)
            //             $("#verify_email").val("asdfadfadfads") 
            //             location.href="{{ route('email.toverify') }}"
            //         },
            //         error: function() {
            //             console.log('error');
            //         }
            //     })

            
        })

        console.log($("#registered").val())

        if($("#registered").val() == "uncompleted"){

            setTimeout(function() {
                cuteAlert({
                    type: "question",
                    title: "INVIZZ",
                    message: "You should complete your profile to promote yourself, Would you complete your profile?",
                    confirmText: "Yes",
                    cancelText: "No, Thanks."
                }).then((e)=>{
                    console.log(e)
                    if (e == ("confirm")){
                        @guest
                        @else
                        location.href="/profile/{{Auth::user()->id}}"
                        @endguest
                    }else{
                        
                    }
                })         
            }, 3000);
            
        } 

        $("#join_invizz_register").click(function(){
            $("#email").val($("#email_register").val())
            console.log($("#email_register").val())
        })

        $("#btn_login").click(function() {

            var email = $("#emails").val()
            var password = $("#password").val()
            console.log(email, password)

            if(email == ""){
                tata.info('INVIZZ', "Input failed!")
            }else{
                $.ajax({
                    url: "{{ route('login') }}",
                    type: 'POST',
                    data: {'_token': '{{ csrf_token() }}', 'email':email, 'password':password, 'remember':'on'},
                    success: function(result) {

                        setTimeout(function() {
                            location.reload()
                        }, 1500);
                        
                        tata.success('INVIZZ', "Login Success!")
                    },
                    error: function() {
                        tata.error('INVIZZ', "Login Failed!")
                    }

                })
            }
           
        })
    })
</script>
