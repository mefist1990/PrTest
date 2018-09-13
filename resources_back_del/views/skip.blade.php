@extends('layouts.new')

@section('content')
<div class="content-body"><!-- stats -->





<section id="basic-listgroup">
  <div class="row match-height">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="height: 378px;">
        <div class="card-header">






<h4 class="card-title"></h4>


          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">

          </div>
        </div>
        <div class="card-body collapse in">
<div class="card-block">
<p>{!! $issues->description !!}</p>




      <div class="btn-toolbar" role="toolbar" style="margin: 0;">
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="back" disabled="disabled">Назад</button>
                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">
      </div>

<form action="skip" name="myform">
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="0">Не согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="0">Нейтрален</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="10">Согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="20">Полностью согласен</button>
      </div>
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="skip">Пропустить</button>
      </div>
</div>


                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">
                  <input type="hidden" name="skip_diarytests_id" value="{!! $skip_diarytests_id !!}">
</form>



          </div>
        </div>
      </div>
    </div>
  
  </div>
</section>



</div>
@endsection
