@props(['book'])

<script>
    $("#checkout").on("click", () => {
        window.location.href = "{{ route('checkOutCart') }}"
    })
    // shopping cart
    $('#btnMiniCart').on("click", function() {
        $('#miniCartModal').show();
    })
    $('.closeCart').on("click", function() {
        $('#miniCartModal').hide();
    })
    //mini cart
    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '{{ route('getMiniCart') }}',
            dataType: 'json',
            success: function(response) {
                console.log(response)
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);
                let miniCart = "";
                if (response.carts.length != 0) {
                    $.each(response.carts, function(key, value) {
                        miniCart +=
                            `
                                    <tr class="book_id" data-book-id="${ value.rowId }">
                                        <td class="w-25">
                                            <img src="${ value.options.cover }"
                                                    class="img-fluid img-thumbnail" alt="Sheep">
                                        </td>
                                        <td>${ value.name }</td>
                                        <td><span>${ value.price }</span></td>
                                        <td class="qty">
                                            <div class="quantityupdateform d-flex gap-3">
                                                <a class="quantityupdate__minus">
                                                    <span><i class="fa-solid fa-minus"></i></span>
                                                </a>
                                                <input name="quantityupdate1" type="text" class="quantityupdate__input" value="${ value.qty }">
                                                <a class="quantityupdate__plus">
                                                    <span><i class="fa-solid fa-plus"></i></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>${ value.subtotal }</td>
                                        <td>
                                            <a href="#" id="removeBook" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    `
                    });
                    $("#checkout").attr("disabled", false);
                } else {
                    miniCart = `Bạn chưa đặt đơn hàng nào cả!`;
                    $("#checkout").attr("disabled", true);
                }
                $('#miniCartBooks').html(miniCart);
            }
        })
    }
    miniCart();
    // update quantity minicart
    $(document).on("click", ".quantityupdate__minus", function(e) {
        e.preventDefault();

        var currentQuantity = parseInt($(this).siblings('.quantityupdate__input').val());
        if (currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
            $(this).siblings('.quantityupdate__input').val(newQuantity);
            var productId = $(this).closest('tr').data('book-id');

            updateQuantity(productId, newQuantity);
        }
    });
    $(document).on("click", ".quantityupdate__plus", function(e) {
        e.preventDefault();

        var currentQuantity = parseInt($(this).siblings('.quantityupdate__input').val());
        var newQuantity = currentQuantity + 1;
        $(this).siblings('.quantityupdate__input').val(newQuantity);
        var productId = $(this).closest('tr').data('book-id');

        updateQuantity(productId, newQuantity);
    });
    // Hàm để cập nhật số lượng sản phẩm thông qua Ajax
    function updateQuantity(productId, newQuantity) {
        // console.log(productId, newQuantity);
        $.ajax({
            type: 'POST',
            url: '{{ route('updateQuantity') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                productId: productId,
                newQuantity: newQuantity,
            },
            dataType: 'json',
            success: function(response) {
                // Xử lý phản hồi từ máy chủ (nếu cần)
                console.log(response);
            }
        });
        miniCart();
    }
    $(document).on("click", "#removeBook", function(e) {
        e.preventDefault();
        var rowId = $(this).closest('tr').data('book-id');
        removeBookCart(rowId)
    })

    function removeBookCart(rowId) {
        $.ajax({
            url: '{{ route('removeBookCart') }}',
            method: 'DELETE',
            data: {
                rowId: rowId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                miniCart();
            }
        })
    }
</script>
