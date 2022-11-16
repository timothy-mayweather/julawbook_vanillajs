<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title ?? 'Julawbook'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('interface/admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Julaw favicon -->
    <link rel="icon" href="{{asset('images/julaw.png')}}" type="image/x-icon" style="border-radius: 15px">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/DataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/css/buttons.bootstrap5.min.css')}}">
    <!-- Date picker -->
    <link rel="stylesheet" href="{{ asset('interface/mc-datepicker/dist/mc-calendar.min.css') }}" />
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <!-- Drag and drop file upload -->
    <link href="{{ asset('interface/uploader-master/dist/css/jquery.dm-uploader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('interface/uploader-master/demo/styles.css') }}" rel="stylesheet">
  </head>
  <body class="hold-transition layout-fixed">
    <div class="wrapper">
      @include('layouts.navbar')
      @include('layouts.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @include('dashboard')
        @include('records')
        @include('registry')
      </div>

      <!-- /.content-wrapper -->
      @include('layouts.footer')
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('interface/admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 5 -->
    <script src="{{ asset('interface/admin/plugins/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('interface/admin/plugins/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Responsive-2.2.9/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('interface/admin/plugins/DataTables/Buttons-1.7.1/js/buttons.colVis.min.js') }}"></script>
    <!-- MC-calender -->
    <script src="{{ asset('interface/mc-datepicker/dist/mc-calendar.min.js') }}"></script>
    <!-- Main js -->
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Notify.js -->
    <script src="{{ asset('interface/admin/plugins/notify.min.js')}}"></script>
    <!-- overlayScrollbars (scrollbars indeed) -->
    <script src="{{ asset('interface/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App (hosts main.js for the app)-->
    <script src="{{ asset('interface/admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes (hosts the left sidebar settings)-->
    <script src="{{ asset('interface/admin/dist/js/demo.js')}}"></script>
    <!-- UIComponents -->
    <script src="{{ asset('js/components.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/crudTable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/registry.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/records.js') }}" type="text/javascript"></script>
    <!-- Drag and drop upload -->
    <script src="{{ asset('interface/uploader-master/src/js/jquery.dm-uploader.js') }}"></script>
    <script src="{{ asset('interface/uploader-master/src/js/ui-multiple.js') }}"></script>
    <script src="{{ asset('interface/uploader-master/src/js/controls.js') }}"></script>
    <script>
      $('.form-table').on('click', 'input[type=text]', function(){
        let el = $(this);
        if (el.attr('class').match(/(input-lower|input-upper|input-float|input-int)/g)&&!el.attr('class').match(/(input-valid)/g)) {
          el.attr('class',el.attr('class')+' input-valid');
          el.on('input',()=>inputValidate(el[0]));
        }
      });
    </script>
  </body>
</html>
