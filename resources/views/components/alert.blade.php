@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('secondary'))
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        {{ session()->get('secondary') }}
    </div>
@endif
@if (session()->has('primary'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session()->get('primary') }}
    </div>
@endif
@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session()->get('warning') }}
    </div>
@endif
@if (session()->has('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('danger') }}
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session()->get('info') }}
    </div>
@endif
@if (session()->has('light'))
    <div class="alert alert-light alert-dismissible fade show" role="alert">
        {{ session()->get('light') }}
    </div>
@endif
@if (session()->has('dark'))
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        {{ session()->get('dark') }}
    </div>
@endif
