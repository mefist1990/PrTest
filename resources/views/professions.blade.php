@extends('layouts.new')

@section('content')
<div class="content-body"><!-- stats -->





<section id="basic-listgroup">
  <div class="row match-height">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="height: 378px;">
        <div class="card-header">






<h4 class="card-title">Экспорт-Импорт Профессий</h4>


          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">

          </div>
        </div>
        <div class="card-body collapse in">
          <div class="card-block">

    <a href="{{ URL::to('downloadProfessions/xls') }}"><button class="btn btn-success">Скачать список профессий Excel xls</button></a>
    <a href="{{ URL::to('downloadProfessions/xlsx') }}"><button class="btn btn-success">Скачать список профессий Excel xlsx</button></a>
    <a href="{{ URL::to('downloadProfessions/csv') }}"><button class="btn btn-success">Скачать список профессий CSV</button></a>
    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('professions') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="import_file" />
      <button class="btn btn-primary">Загрузить профессии</button>
    </form>

          </div>




          </div>
        </div>
      </div>
    </div>

  </div>
</section>



</div>
@endsection
