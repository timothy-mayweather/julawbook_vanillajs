<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <form class="form-inline ml-3" id="user-nav-form">
    <div class="input-group input-group-sm">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="far fa-calendar-alt"></i>
        </span>
      </div>
      <input class="form-control form-control-navbar col-md-2" placeholder="choose date" type="text"  name="datepicker" id="datepicker" title="choose date" style="font-weight:bold; cursor:pointer; color:green; border: 1px solid #ced4da" required>
      <div class="input-group-prepend shift-field" hidden>
        <span class="input-group-text bg-gradient-white border-transparent">
          Shift:
        </span>
      </div>
      <input class="form-control form-control-navbar col-2 shift-field" type="number"  name="shift" id="shift" title="choose shift" style="font-weight:bold; cursor:pointer; color:green; border: 1px solid #ced4da;" required hidden>
    </div>
  </form>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
