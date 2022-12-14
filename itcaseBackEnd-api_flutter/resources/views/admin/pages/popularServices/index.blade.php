@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title') Популярные услуги @endsection

@section('content')
    @include('admin.components.breadcrumb', ['lastTitle' => 'Популярные услуги'])
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Популярные <small>услуги</small></h3>
            <div class="block-options">
                <a href="{{ route('admin.popular.create') }}" class="btn btn-alt-primary"><i
                        class="fa fa-plus mr-5"></i>Добавить популярный сервис</a>
            </div>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Заголовок</th>
                        <th class="text-center">Описание</th>
                        <th class="text-center">Ссылка</th>
                        <th class="text-center" style="width: 15%">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $service)
                        <tr>
                            <td class="text-center"><img src="{{ $service->getImg() }}" alt="" class="img-avatar">
                            </td>
                            <td class="font-w600 text-center">{{ $service->getTitle() }}</td>
                            <td class="text-center">{!! $service->getContent() !!}</td>
                            <td class="text-center">{{$service->url}}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center h-100">
                                    <a href="{{ route('admin.popular.edit', $service->id) }}"
                                       data-toggle="tooltip" title="Редактировать" class="btn btn-sm btn-alt-info"><i
                                            class="fa fa-edit"></i></a>
                                    <form method="post"
                                          action="{{ route('admin.popular.destroy', $service->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button style="border: none; cursor: pointer; background-color: transparent;"
                                                class="btn btn-sm btn-alt-danger"
                                                onclick="return confirm('Вы уверены?')" data-toggle="tooltip"
                                                title="Удалить">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        jQuery('.js-dataTable-full').dataTable({
            "order": [],
            pageLength: 10,
            lengthMenu: [[10, 20, 30, 50], [10, 20, 30, 50]],
            autoWidth: true,
            language: ru_datatable
        });

        $('.position').change(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData;
            formData.append('id', $(this).data('id'));
            formData.append('position', $(this).val());
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.categories.change.position') }}',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.position').attr('disabled', 'disabled');
                },
                success: function () {
                    $('.position').removeAttr('disabled', '');
                },
                error: function (data) {
                    console.log(data);
                    $('.position').removeAttr('disabled', '');
                }
            })
        });
    </script>
@endsection
