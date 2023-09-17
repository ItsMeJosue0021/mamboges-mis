@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-5 left-1/2 bg-blue-600 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-50">
        <p>{{session('message')}}</p>
    </div>
@elseif (session()->has('error'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-5 left-1/2 bg-red-700 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-50">
        <p>{{session('error')}}</p>
    </div>
@elseif (session()->has('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-5 left-1/2 bg-green-700 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-50">
        <p>{{session('success')}}</p>
    </div>
@endif