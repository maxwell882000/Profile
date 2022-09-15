@extends("layout.admin_layout")
@section("content")
    <x-helper.form.form_next :form="$form" :enctype="true">
        @yield("action")
    </x-helper.form.form_next>
@endsection
