<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <ul id="notificationList">he</ul>

    <script src="https://cdn.socket.io/4.2.0/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.4/dist/echo.min.js"></script>

    <script>
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001' // Cổng tùy thuộc vào cấu hình của bạn
        });

        window.Echo.channel('notifications')
            .listen('NotificationEvent', (e) => {
                console.log('Đã nhận được thông báo: ' + e.message);
                const notificationList = document.getElementById('notificationList');
                const newNotification = document.createElement('li');
                newNotification.textContent = e.message;
                notificationList.appendChild(newNotification);
            });
    </script>
</body>

</html>
