@extends('admin-panel.layouts.home')

@section('content')
<div class="main-content" >
	<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">


		@if ($counter <= $issues_result)
		<h1 class="mainTitle">Вопрос {!! $counter !!} / {!! $issues_result !!}</h1>
		@else
		<h1 class="mainTitle">Вопросов нет</h1>
		@endif
		@if ($counter <= $issues_result)
		<span class="mainDescription">{!! $issues->description !!}</span>
		@else
		<span class="mainDescription">Воросов больше нет</span>
		<form action="reset" name="myform">
                  <button type="submit" class="btn list-group-item" name="answer">Начать заново</button>
		</form>
		@endif

								</div>
								<ol class="breadcrumb">
									<li>
										<span>Forms</span>
									</li>
									<li class="active">
										<span>Form Elements</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Пояснение к вопросу:</h5>
									<p>
										Пояснение к вопросу
									</p>
									<div class="row margin-top-30">

										<div class="col-lg-12 col-md-12">
											<div class="panel panel-white">

												<div class="panel-body">

													
@if ($counter <= $issues_result)

@if ($counter == 1)
<form action="back" name="myform">

      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="back" disabled="disabled">Назад</button>
                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">
      </div>

</form>


<form action="test" name="myform">
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="0">Не согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="0">Нейтрален</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="10">Согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="20">Полностью согласен</button>
      </div>

      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="skip">Пропустить</button>
      </div>



                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">
</form>
@else
<form action="back" name="myform">

      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="back">Назад</button>
                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">
      </div>

</form>

<form action="test" name="myform">
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="0">Не согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="0">Нейтрален</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="10">Согласен</button>
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="20">Полностью согласен</button>
      </div>
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer"  value="skip">Пропустить</button>
      </div>



                  <input type="hidden" name="issues_id" value="{!! $issues->id !!}">
                  <input type="hidden" name="counter" value="{!! $counter !!}">

</form>

@endif
@endif


												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->

					</div>
				</div>
@endsection
