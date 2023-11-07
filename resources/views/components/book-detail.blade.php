@props(['book'])

<script>
    // update quantity detail book
    let quantity = 1;
    $('.quantity__minus').click(function(e) {
        e.preventDefault();
        var input = $(this).siblings('.quantity__input');
        var value = parseInt(input.val());
        if (value > 1) {
            value--;
        }
        input.val(value.toString().padStart(2, '0'));

        quantity = value;
    });
    $('.quantity__plus').click(function(e) {
        e.preventDefault();
        var input = $(this).siblings('.quantity__input');
        var value = parseInt(input.val());
        value++;
        input.val(value.toString().padStart(2, '0'));

        quantity = value;
    });
    // add book to cart
    function addToCart(idBook, quantity) {
        $.ajax({
            url: '{{ route('addToCart', $book->id) }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                idBook: idBook,
                quantity: quantity,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response)

                toastr.success(response.success, 'Nofication:', {
                    timeOut: 3000,
                    positionClass: 'toast-bottom-center'
                })
            }
        })
        miniCart();
        console.log(idBook, quantity)
    }
    $('#addToCart').on('click', function(e) {
        e.preventDefault();
        $("#cartQty").addClass("animate__animated tuanpeo");

        setTimeout(function() {
            $("#cartQty").removeClass("animate__animated tuanpeo");
        }, 2000);

        addToCart({{ $book->id }}, quantity);
    })
</script>
