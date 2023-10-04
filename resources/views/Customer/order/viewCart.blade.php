<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Show cart</title>
</head>

<body>
    <div class="cart_wrapper">
        @include('Customer.order.components.cart_component')
    </div>
    <script type="text/javascript">
        $(document).on('click', '.cart_remove', function() {
            let id = $(this).data('id');
            remove(id);
        });

        $(document).on('input', '.cart_update', function() {
            let id = $(this).data('id');
            let quantity = $(this).parents('tr').find('input.quantity').val();
            update(id, quantity);
        });


        function update(id, quantity) {
            $.ajax({
                type: "POST",
                url: "{{ route('customer.order.update') }}",
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

        function remove(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('customer.order.remove') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.code === 200) {
                        $('.cart_wrapper').html(data.cart_component);
                        showFeedbackMessage('Dish removed from cart.', 'success');
                    }
                },
                error: function() {
                    showFeedbackMessage('Failed to remove dish from cart. Please try again later.', 'error');
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
