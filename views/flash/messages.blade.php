@if(session()->has('success'))
    <div class="alert alert-success">
        <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif
