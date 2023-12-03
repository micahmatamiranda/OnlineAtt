@if (session()->has('message'))

    <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="bg-green-100 fixed left-0 z-50 border-t border-b border-green-500 text-green-700 px-4 py-3 rounded" role="alert">
        <p class="font-bold">Alert Message</p>
        <p class="text-sm">{{ session('message') }}</p>
    </div>
    
@endif
