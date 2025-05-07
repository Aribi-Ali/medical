<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HealthHub - Your Health Journey Starts Here</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-white">
    @yield("content")

    <script>
        // Function to show the notification
        function showNotification(message, subMessage = null) {
            const notification = document.getElementById('notification');

            // Update the notification content
            notification.querySelector('.text-gray-900').textContent = message;
            if (subMessage) {
                notification.querySelector('.text-gray-500').textContent = subMessage;
            } else {
                const subMessageElement = notification.querySelector('.text-gray-500');
                if (subMessageElement) {
                    subMessageElement.remove();
                }
            }

            // Show the notification
            notification.classList.remove('hidden');

            // Automatically hide the notification after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000); // Adjust the duration as needed
        }

        // Function to hide the notification
        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.add('hidden');
        }

        // Automatically show the notification if it exists
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('notification');
            if (notification) {
                const message = notification.querySelector('.text-gray-900').textContent;
                const subMessageElement = notification.querySelector('.text-gray-500');
                const subMessage = subMessageElement ? subMessageElement.textContent : null;

                showNotification(message, subMessage);
            }
        });
    </script>
</body>
</html>
