<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button-hover w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-dashboardPrimary-600 hover:bg-dashboardPrimary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dashboardPrimary-500']) }}>
    {{ $slot }}
</button>
