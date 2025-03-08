<div>
    @if (config('app.isActiveSuccessMessage') && session()->has('success'))
        <script>
            Swal.fire(createSwalConfig('Message', '{{ session('success') }}', 'success', 'OK'));
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            alertNotify('{{ session('success') }}', 'error')
        </script>
    @endif

    @if (session()->has('debug'))
        <script>
            // Swal.fire(createSwalConfig('Message', 'Please scroll down for console', 'error', 'OK'));
        </script>
    @endif

    @if ($message = Session::get('debug'))
        <div id="successalert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
</div>
