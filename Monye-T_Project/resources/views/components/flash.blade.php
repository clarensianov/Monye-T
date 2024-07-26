@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 position-absolute w-85" style="bottom: -20px;" role="alert">
        {{ session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 position-absolute w-85" style="bottom: -20px;" role="alert">
        {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


