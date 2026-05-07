<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-mustard-400 border border-transparent rounded-2xl font-bold text-sm text-white shadow-lg shadow-mustard-100 hover:bg-mustard-500 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-mustard-500 focus:ring-offset-2 transition-all duration-200 active:scale-[0.98]']) }}>
    {{ $slot }}
</button>
