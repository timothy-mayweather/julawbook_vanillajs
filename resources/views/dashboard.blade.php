@php
  $debtors = array("Vickie"=>"85000/=","Sanyu"=>"60000/=","Bobly"=>"20000/=","Mzee"=>"1000000/=");
  $items = array("2T"=>5,"Helix"=>8,"RubiaXT"=>25,"BrakeFluid"=>12);
@endphp

<div id="dashboard" hidden="hidden">
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box" style="height: 170px;">
            <a href="#" class="small-box-footer bg-primary" style="height: 20%"><span style="color: black">Est. fuel in tank <i class="fas fa-glass-whiskey"></i></span></a>
            <div class="inner" style="padding: 5px; height: 80%; overflow: auto" id="est-fuel"></div>
          </div>
        </div>
        <!--./col-->
        <div class="col-lg-3 col-6">
          <!--small box-->
          <div class="small-box" style="height: 170px;">
            <a href="#" class="small-box-footer bg-success" style="height: 20%"><span style="color: black">Fuel sold today <i class="fas fa-tint"></i></span></a>
            <div class="inner" style="height: 80%; overflow: auto" id="today-fuel"></div>
          </div>
        </div>
        <!--./col-->
        <div class="col-lg-3 col-6">
          <!--small box-->
          <div class="small-box" style="height: 170px;">
            <a href="#" class="small-box-footer bg-warning" style="height: 20%">Debtors More info <i class="fas fa-arrow-circle-right"></i></a>
            <div class="inner" style="height: 80%; overflow: auto" id="curr-debtors">
{{--              @foreach($debtors as $debtor=>$debt)--}}
{{--                <p style="padding: 3px;"><b>{{$debtor}}: {{$debt}}</b></p>--}}
{{--              @endforeach--}}
            </div>
          </div>
        </div>
        <!--./col-->
        <div class="col-lg-3 col-6">
          <!--small box-->
          <div class="small-box" style="height: 170px;">
            <a href="#" class="small-box-footer bg-danger" style="height: 20%"><span style="color: black">Inventory More info <i class="fas fa-arrow-circle-right"></i></span></a>
            <div class="inner" style="height: 80%; overflow: auto" id="inv-status">
{{--              @foreach($items as $item=>$no)--}}
{{--                <p style="padding: 1px;"><b>{{$item}}: {{$no}}</b></p>--}}
{{--              @endforeach--}}
            </div>
          </div>
        </div>
        <!--./col-->
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
