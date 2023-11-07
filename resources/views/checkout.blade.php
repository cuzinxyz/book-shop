@extends('layouts.web')

@section('content')
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="cartQtyCO badge badge-secondary badge-pill">{{ $cartQty }}</span>
        </h4>
        <ul class="list-group mb-3">
            @foreach ($carts as $cart)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">{{ $cart->name }}</h6>
                    <small class="text-muted">qty: {{ $cart->qty }}</small>
                </div>
                <span class="text-muted">${{ $cart->price }}</span>
            </li>
            @endforeach

            <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>${{ $cartTotal }}</strong>
            </li>
        </ul>
    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Shipping address</h4>
        <form class="needs-validation" id="formCheckOut">
{{--            full name--}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Do" value=""
                        required="">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Abner" value=""
                        required="">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>
{{--            phone number--}}
            <div class="mb-3">
                <label for="phone_number">Phone number</label>
                <input type="tel" class="form-control" id="phone_number" placeholder="0986.686.868" required="">
                <div class="invalid-feedback">
                    Please enter a valid phone number for shipping updates.
                </div>
            </div>
{{--            email--}}
            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>
{{--            address 1 & 2--}}
            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
            </div>
            <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>
            <hr class="mb-4">
{{--            payment method --}}
            <h4 class="mb-3">Payment</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input"
                        checked="" required="" value="payment on delivery">
                    <label class="custom-control-label" for="credit">Payment on delivery</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="stripe" name="paymentMethod" type="radio" class="custom-control-input"
                        required="" value="stripe">
                    <label class="custom-control-label" for="stripe">Stripe</label>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
    </div>
</div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function() {
            $("#formCheckOut").on("submit", function(e) {
                e.preventDefault();

                if (validateForm()) {
                    // Thu thập dữ liệu từ các trường và đặt chúng vào một đối tượng
                    var formData = {
                        user_id: {{ auth()->id() }},
                        fullname: $("#firstName").val() + " " + $("#lastName").val(),
                        cart_orders: {!! $carts !!} ,
                        cart_total: {{ $cartTotal }},
                        phone_number: $("#phone_number").val(),
                        email: $("#email").val(),
                        address: $("#address").val(),
                        address2: $("#address2").val(),
                        payment_method: $("input[name=paymentMethod]:checked").val(),
                    };
                    toastr.success('Order successfully!', 'Notification:', {timeOut: 3000})

                    console.log(formData)
                    // Gửi dữ liệu đến máy chủ qua Ajax
                    $.ajax({
                        url: "{{ route('checkOutCart') }}", // Thay đổi thành URL của máy chủ
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        success: function(response) {
                            // Xử lý phản hồi từ máy chủ (nếu cần)
                            console.log(response);
                            setTimeout(() => {
                                window.location.href = "/library/order"
                            }, 3000)
                        }
                    });
                }
            });

            function validateForm() {
                // Thực hiện kiểm tra tất cả các trường và hiển thị thông báo lỗi nếu cần
                var valid = true;
                $(".form-control").each(function() {
                    if ($(this).prop("required") && $(this).val() === "") {
                        $(this).addClass("is-invalid");
                        valid = false;
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

                return valid;
            }
        });
    </script>
@endpush
