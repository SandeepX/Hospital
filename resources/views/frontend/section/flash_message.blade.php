@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session()->has('success_message'))
    <div style="max-width: 100%" id="message"   class="alert alert-success">
        {{session('success_message')}}
    </div>
    {{session()->forget('success_message')}}
@endif

@if(session()->has('error_message'))
    <div style="max-width: 100%" id="message" class="alert alert-danger ">
        {{session('error_message')}}
    </div>
    {{session()->forget('error_message')}}
@endif








