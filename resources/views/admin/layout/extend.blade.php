@include('admin.layout.head')
<body id="page-top">
  <div id="wrapper">
    @include('admin.layout.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        @include('admin.layout.navbar')
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('page-name')</h1>
          </div>
          @yield('content')
        </div>
        <!---Container Fluid-->
      </div>
      @include('admin.layout.footer')
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('sweetalert::alert')
  <script src="{{ asset('dist/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('dist/js/ruang-admin.min.js') }}"></script>
  @stack('js')
</body>

</html>