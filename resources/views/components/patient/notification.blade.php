<div id="notification" class="fixed top-4 right-4 z-50 animate-notification hidden">
    <div class="bg-white rounded-lg shadow-lg p-4 border-l-4 border-dashboardPrimary-500">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <span class="text-2xl">✅</span>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                    {{ $message }}
                </p>
                @if(isset($subMessage))
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $subMessage }}
                    </p>
                @endif
            </div>
            <button
                onclick="hideNotification()"
                class="ml-4 text-gray-400 hover:text-gray-500 focus:outline-none"
            >
                ✕
            </button>
        </div>
    </div>
</div>

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
</script>
