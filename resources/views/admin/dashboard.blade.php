@extends('admin.layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    {{  $chart->container() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    {{-- <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush
