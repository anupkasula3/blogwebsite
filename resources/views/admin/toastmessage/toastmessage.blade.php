@if (Session::has('success'))
    <div class="alert alert-danger mb-4">
        <div class="bg-[#ff3131] border  max-sm:text-sm border-[#ff3131] text-[#ff3131] px-4 py-3 rounded relative"
            role="alert" style="height: 50px;">
            <p>{{ Session::get('success') }}</p>
            <button type="button" class="absolute top-0 right-0 mt-1 mr-2 close-button" data-dismiss="alert"
                aria-label="Close">
                <span class="text-[#ff3131]">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (Session::has('message'))
    <div class="alert alert-danger mb-4">
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert"
            style="height: 50px;">
            <p>{{ Session::get('message') }}</p>
            <button type="button" class="absolute top-0 right-0 mt-1 mr-2 close-button" data-dismiss="alert"
                aria-label="Close">
                <span class="text-blue-700">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger mb-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"
            style="height: 50px;">
            <p>{{ Session::get('error') }}</p>
            <button type="button" class="absolute top-0 right-0 mt-1 mr-2 close-button" data-dismiss="alert"
                aria-label="Close">
                <span class="text-red-700">&times;</span>
            </button>
        </div>
    </div>
@endif
@if (Session::has('errorimage'))
    <div class="alert alert-danger mb-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"
            style="height: 60px;">
            <p>{{ Session::get('errorimage') }}</p>
            <button type="button" class="absolute top-0 right-0 mt-1 mr-2 close-button" data-dismiss="alert"
                aria-label="Close">
                <span class="text-red-700">&times;</span>
            </button>
        </div>
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var closeButton = document.querySelector('.close-button');
        var alertBox = document.querySelector('.alert');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                hideAlert();
            });
        }
        // setTimeout(function() {
        //     hideAlert();
        // }, 2000);
        function hideAlert() {
            alertBox.remove(); // Remove the alert box from the DOM
        }
    });
</script>

@if (Session::has('poperror'))
    <div id="toast-error"
        class="fixed bottom-0 z-[999] right-4 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow opacity-0 transform scale-95 transition-all duration-300 ease-in-out"
        role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{ Session::get('poperror') }}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#toast-error" aria-label="Close" onclick="closeToast('toast-error')">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

@if (Session::has('popsuccess'))
    <div id="toast-success"
        class="fixed bottom-0 z-[999] right-4 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow opacity-0 transform scale-95 transition-all duration-300 ease-in-out"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-[#ff3131] bg-[#ff3131] rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Success icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{ Session::get('popsuccess') }}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#toast-success" aria-label="Close" onclick="closeToast('toast-success')">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

<script>
    // Show toasts on window load
    window.onload = function() {
        const successToast = document.getElementById('toast-success');
        const errorToast = document.getElementById('toast-error');

        if (successToast) {
            successToast.classList.add('opacity-100', 'scale-100');
            setTimeout(() => closeToast('toast-success'), 5000);
        }


        if (errorToast) {
            errorToast.classList.add('opacity-100', 'scale-100');
            setTimeout(() => closeToast('toast-error'), 5000);
        }
    };

    // Close the toast with animation
    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('opacity-100', 'scale-100');
            toast.classList.add('opacity-0', 'scale-95');
            setTimeout(() => toast.remove(), 300); // Remove element after animation
        }
    }
</script>
