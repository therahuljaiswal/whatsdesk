<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof plans !== 'undefined' && plans.length > 0) {
            
            plans.forEach(function(plan) {
                // Ignore free plan or zero price
                if(plan.price > 0) {
                    var container = document.getElementById('button-container-plan-' + plan.id);
                    if (container) {
                        var btn = document.createElement('button');
                        btn.className = 'btn btn-primary';
                        btn.innerText = '{{ __("Switch to") }} ' + plan.name;
                        btn.onclick = function() {
                            initRazorpayPayment(plan);
                        };
                        container.appendChild(btn);
                    }
                }
            });
        }
    });

    function initRazorpayPayment(plan) {
        // Create an order first
        fetch('{{ route("razorpaysubscribe.create_order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                plan_id: plan.id
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                var options = {
                    "key": data.key, 
                    "amount": data.amount, 
                    "currency": data.currency,
                    "name": "{{ config('app.name') }}",
                    "description": "Upgrade to " + data.plan_name,
                    "order_id": data.order_id, 
                    "handler": function (response){
                        // Submit to our callback route via a hidden form
                        var form = document.createElement("form");
                        form.method = "POST";
                        form.action = "{{ route('razorpaysubscribe.callback') }}";

                        var csrfField = document.createElement("input");
                        csrfField.type = "hidden";
                        csrfField.name = "_token";
                        csrfField.value = "{{ csrf_token() }}";
                        form.appendChild(csrfField);

                        var planField = document.createElement("input");
                        planField.type = "hidden";
                        planField.name = "plan_id";
                        planField.value = plan.id;
                        form.appendChild(planField);

                        var paymentIdField = document.createElement("input");
                        paymentIdField.type = "hidden";
                        paymentIdField.name = "razorpay_payment_id";
                        paymentIdField.value = response.razorpay_payment_id;
                        form.appendChild(paymentIdField);

                        var orderIdField = document.createElement("input");
                        orderIdField.type = "hidden";
                        orderIdField.name = "razorpay_order_id";
                        orderIdField.value = response.razorpay_order_id;
                        form.appendChild(orderIdField);

                        var signatureField = document.createElement("input");
                        signatureField.type = "hidden";
                        signatureField.name = "razorpay_signature";
                        signatureField.value = response.razorpay_signature;
                        form.appendChild(signatureField);

                        document.body.appendChild(form);
                        form.submit();
                    },
                    "prefill": {
                        "name": data.user_name,
                        "email": data.user_email
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response){
                    alert("Payment failed: " + response.error.description);
                });
                rzp1.open();
            } else {
                alert("Could not initiate payment: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred while initializing payment.");
        });
    }
</script>
