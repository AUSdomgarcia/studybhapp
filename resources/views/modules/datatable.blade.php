<!-- Styles -->
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}">
@endsection

<!-- Scripts -->
@section('scripts')
@parent
<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
@endsection
