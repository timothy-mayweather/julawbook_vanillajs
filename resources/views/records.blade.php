<form id="user_form" hidden>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div id="store-files" hidden>
            <main role="main" class="container pt-2" id="drop-container" hidden>

              <div class="row">
                <div class="col-md-6 col-sm-12">

                  <div id="drag-and-drop-zone" class="dm-uploader p-5 text-center">
                    <h4 class="mb-5 mt-5 text-muted">Drag &amp; drop Files here</h4>

                    <div class="btn btn-block mb-5">
                      <span><i class="fas fa-arrow-alt-circle-right"></i>Click here to select files</span>
                      <input type="file" title="Click to add Files" multiple="">
                    </div>
                  </div><!-- /uploader -->

                  <div class="mt-2">
                    <a href="#" class="btn btn-primary" id="btnApiStart">
                      <i class="fa fa-play"></i> Start
                    </a>
                    <a href="#" class="btn btn-danger" id="btnApiCancel">
                      <i class="fa fa-stop"></i> Stop
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12" style="resize: none">
                  <div class="card h-100">
                    <div class="card-header">
                      File List
                    </div>

                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                      <li class="text-muted text-center empty">No files uploaded.</li>
                    </ul>
                  </div>
                </div>
              </div><!-- /file list -->

              <!-- File item template -->
              <script type="text/html" id="files-template">
                <li class="media">

                  <div class="media-body mb-1">
                    <p class="mb-2">
                      <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                    </p>
                    <div class="progress mb-2">
                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                           role="progressbar"
                           style="width: 0"
                           aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>

                    <p class="controls mb-2">
                      <button class="btn btn-sm btn-primary start" role="button">Start</button>
                      <button class="btn btn-sm btn-danger cancel" role="button" disabled="disabled">Cancel</button>
                    </p>
                    <hr class="mt-1 mb-1" />
                  </div>
                </li>
              </script>

            </main> <!-- /container -->
          </div>
          <div id="meters" hidden></div>
          <div id="dips" hidden></div>
          <div id="sales" hidden></div>
          <div id="receivables" hidden></div>
          <div id="transactions" hidden></div>
          <div id="debts" hidden></div>
          <div id="prepaid" hidden></div>
          <div id="expenses" hidden></div>
          <div id="inventory" hidden></div>
          <div id="report" hidden></div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</form>
