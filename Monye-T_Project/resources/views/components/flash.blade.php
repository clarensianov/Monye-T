@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 position-absolute w-85" style="bottom: -20px;" role="alert">
        {{ session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-error alert-dismissible fade show mt-3 position-fixed w-85" style="bottom: -90px;" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


