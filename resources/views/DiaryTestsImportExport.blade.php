@extends('layouts.new')

@section('content')
<div class="content-body"><!-- stats -->





<section id="basic-listgroup">
  <div class="row match-height">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="height: 378px;">
        <div class="card-header">






<h4 class="card-title">Скачать ответы на тесты</h4>


          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">

          </div>
        </div>
        <div class="card-body collapse in">
          <div class="card-block">

    <a href="{{ URL::to('DiaryTestsDownloadExcel/xls') }}"><button class="btn btn-success">Скачать Excel xls</button></a>
    <a href="{{ URL::to('DiaryTestsDownloadExcel/xlsx') }}"><button class="btn btn-success">Скачать Excel xlsx</button></a>
    <a href="{{ URL::to('DiaryTestsDownloadExcel/csv') }}"><button class="btn btn-success">Скачать CSV</button></a>


          </div>




          </div>
        </div>
      </div>
    </div>

  </div>
</section>



</div>
@endsection
