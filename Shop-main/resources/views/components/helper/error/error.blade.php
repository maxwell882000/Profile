@props(["errors"=>collect([])])
<div>
    {{--    {{dd($errors)}}--}}
    @foreach($errors->all() as $error)
        <div class="text-red-600">
            <span>{!!  $error !!}</span>
        </div>
    @endforeach
    @if(session("view_error"))
        <h1 class="text-red-600">{!! session('view_error') !!}</h1>
    @endif
    @if(session('success'))
        <h1 class="text-green-600">{{session('success')}}</h1>
    @endif
    @if(session('success_view'))
        <h1 class="text-green-600">{{session('success_view')}}</h1>
    @endif
</div>
