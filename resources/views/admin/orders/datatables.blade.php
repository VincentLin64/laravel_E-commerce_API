@extends('layout.admin_app')

@section('content')
    {{ $dataTable->table() }}
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
{{--<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>--}}
