@props([
"form",
"enctype" => false,
"method" => "POST",
])
<div class="flex flex-col pb-10 items-center justify-center text-center space-y-4 mr-4">
    <x-helper.text.title>
        {{$form->title}}
    </x-helper.text.title>
    <hr class="w-full border-dashed border-title_color"/>
    <div class="self-stretch rounded bg-white shadow">
        <x-helper.error.error :errors="$errors"/>
        <form method="POST" id="form" class="flex flex-col justify-center items-center space-y-5 w-full"
              action="{{$form->route_save}}"
              @if($enctype == true) enctype=multipart/form-data @endif>
            @method($method)
            @csrf
            {{$slot}}

        </form>
    </div>
</div>
<script>
    $('#form').submit(function (e) {
        e.preventDefault();
    });
    $("#real_submit").on("click", function () {
        $("#form")[0].submit();
    });
</script>

{{-- probably some code which will send data must be written--}}
