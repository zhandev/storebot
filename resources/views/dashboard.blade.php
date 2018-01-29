@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container" id="app" data-webhooks="{{ json_encode($webhooks) }}">
        <div class="hero text-center">
            <h2>Be aware of your Shopify store</h2>
            <p>Get all the notices of your store on your facebook messenger</p>
            <a href="{{ route('connectMessenger') }}" role="button" class="btn btn-primary">Connect Messenger</a>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>Notifications</p>

                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Orders</p><br>
                                        <button v-on:click="changeStatus('order')" v-bind:class="[webhooks.order === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.order) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Customers</p><br>
                                        <button v-on:click="changeStatus('customer')" v-bind:class="[webhooks.customer === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.customer) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Fulfillment</p><br>
                                        <button v-on:click="changeStatus('fulfillment')" v-bind:class="[webhooks.fulfillment === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.fulfillment) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Fulfillment Event</p>
                                        <button v-on:click="changeStatus('fulfillment_event')" v-bind:class="[webhooks.fulfillment_event === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.fulfillment_event) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Order Transactions</p>
                                        <button v-on:click="changeStatus('order_transaction')" v-bind:class="[webhooks.order_transaction === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.order_transaction) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Cart</p><br>
                                        <button v-on:click="changeStatus('cart')" v-bind:class="[webhooks.cart === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.cart) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Draft Order</p><br>
                                        <button v-on:click="changeStatus('draft_order')" v-bind:class="[webhooks.draft_order === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.draft_order) }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-bordered">
                                    <div class="card-body text-center">
                                        <p class="text-center">Checkout</p><br>
                                        <button v-on:click="changeStatus('checkout')" v-bind:class="[webhooks.checkout === 1 ? 'btn btn-sm btn-primary' : 'btn btn-sm btn-outline-primary']" type="button">@{{ setStringStatus(webhooks.checkout) }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>Connected Messengers</p>
                        @forelse ($messengers as $messenger)
                            <div class="card" style="border: 1px solid #e4e4e4;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $messenger->first_name }} {{ $messenger->last_name }}</h5>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No messengers</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            webhooks: $('#app').data('webhooks')
        },
        created: function () {
            console.log(this.$data.webhooks)
        },
        methods: {
            reverseStatus: function(status) {
               return status === 1 ? 0 : 1;
            },
            setStringStatus: function(status) {
                return status === 1 ? 'Enabled' : 'Disabled';
            },
            changeStatus: function (type) {
                switch (type) {
                    case "order":
                        this.$data.webhooks.order = this.reverseStatus(this.$data.webhooks.order);
                        break;
                    case "customer":
                        this.$data.webhooks.customer = this.reverseStatus(this.$data.webhooks.customer);
                        break;
                    case "fulfillment":
                        this.$data.webhooks.fulfillment = this.reverseStatus(this.$data.webhooks.fulfillment);
                        break;
                    case "fulfillment_event":
                        this.$data.webhooks.fulfillment_event = this.reverseStatus(this.$data.webhooks.fulfillment_event);
                        break;
                    case "order_transaction":
                        this.$data.webhooks.order_transaction = this.reverseStatus(this.$data.webhooks.order_transaction);
                        break;
                    case "cart":
                        this.$data.webhooks.cart = this.reverseStatus(this.$data.webhooks.cart);
                        break;
                    case "draft_order":
                        this.$data.webhooks.draft_order = this.reverseStatus(this.$data.webhooks.draft_order);
                        break;
                    case "checkout":
                        this.$data.webhooks.checkout = this.reverseStatus(this.$data.webhooks.checkout);
                        break;
                }
            }
        },
        watch: {
            webhooks: {
                handler: function (val, oldVal) {
                    $.post('{{ route('updateWebhooks') }}', {webhooks: val}, function(response) {
                        console.log(response)
                    });
                    console.log(val)
                },
                deep: true
            }
        }
    });
</script>
@endsection