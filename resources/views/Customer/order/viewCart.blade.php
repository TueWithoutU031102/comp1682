<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Show cart</title>
</head>

<body>
    <div class="cart_wrapper">
        @include('Customer.order.components.cart_component')
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).on('click', '.cart_update', function() {
            let id = $(this).data('id');
            let quantity = $(this).parents('tr').find('input.quantity').val();
            updateCartItem(id, quantity);
        });

        $(document).on('click', '.cart_delete', function() {
            let id = $(this).data('id');
            deleteCartItem(id);
        });

        function updateCartItem(id, quantity) {
            $.ajax({
                type: "POST",
                url: "{{ route('updateCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    quantity: quantity
                },
                success: function(data) {
                    if (data.code === 200) {
                        $('.cart_wrapper').html(data.cart_component);
                        showFeedbackMessage('Cart updated successfully!', 'success');
                    }
                },
                error: function() {
                    showFeedbackMessage('Failed to update cart. Please try again later.', 'error');
                }
            });
        }

        // Function to delete cart item using AJAX
        function deleteCartItem(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('deleteCart') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.code === 200) {
                        // Update the cart wrapper with the new cart component
                        $('.cart_wrapper').html(data.cart_component);
                        showFeedbackMessage('Item removed from cart.', 'success');
                    }
                },
                error: function() {
                    showFeedbackMessage('Failed to remove item from cart. Please try again later.', 'error');
                }
            });
        }

        function showFeedbackMessage(message, type) {
            let feedbackDiv = $('.cart_feedback');
            feedbackDiv.text(message);
            feedbackDiv.removeClass('alert-success alert-danger').addClass('alert-' + type);
            feedbackDiv.show();
            setTimeout(function() {
                feedbackDiv.hide();
            }, 3000);
        }
    </script>

</body>

</html>
