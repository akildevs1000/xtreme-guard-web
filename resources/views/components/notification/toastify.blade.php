<div>

    @if (session()->has('success'))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alertNotify('{{ session('success') }}', 'success')
                });
            </script>
        @endpush
    @endif

    @if (session()->has('error'))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alertNotify('{{ session('error') }}', 'error')
                });
            </script>
        @endpush
    @endif

    @if (session()->has('debug'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alertNotify('Please scroll down for console', 'error')
            });
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
