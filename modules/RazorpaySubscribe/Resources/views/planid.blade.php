<div class="col-md-6">
    @include('partials.input',['name'=>'Razorpay Plan ID','id'=>"razorpay_id",'placeholder'=>"Optional: Razorpay Plan ID (if using native Razorpay subscriptions)",'required'=>false,'value'=>(isset($plan)?$plan->razorpay_id:null)])
</div>
