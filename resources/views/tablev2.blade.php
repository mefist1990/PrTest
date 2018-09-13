@extends('layouts.new')

@section('content')
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>№</th>
  <th>Профессия (prof_title)</th>
  <th>Всего обязательных ограничений ОТ (total_factor_yes_from)</th>
  <th>Выполненных обязательных ограничений ОТ (total_executed_factor_yes_from)</th>
  <th>Невыполненных обязательных ограничений ОТ (total_unfulfilled_factor_yes_from)</th>
  <th>Всего обязательных ограничений ДО   (total_factor_yes_before)</th>
  <th>Выполненных обязательных ограничений ДО (total_executed_factor_yes_before)</th>
  <th>Невыполненных обязательных ограничений ДО (total_unfulfilled_factor_yes_before)</th>
  <th>Всего необязательных ограничений (total_factor_no)</th>
  <th>Выполненных необязательных ограничений (total_executed_factor_no)</th>
  <th>Невыполненных необязательных ограничений (total_unfulfilled_factor_no)</th>
  <th>Рейтинг (rating)</th>
  <th>Номера тем, по которым не выполняются обязательные ограничения ОТ (array_unfulfilled_json_from)</th>


</tr>
</thead>
<tbody>
  @foreach ($tables as $key => $table)
<tr>
  <th>{{ $key+1 }}</th>
  <th>{{ $table->prof_title }}</th>
  <th>{{ $table->total_factor_yes_from }}</th>
  <th>{{ $table->total_executed_factor_yes_from }}</th>
  <th>{{ $table->total_unfulfilled_factor_yes_from }}</th>
  <th>{{ $table->total_factor_yes_before }}</th>
  <th>{{ $table->total_executed_factor_yes_before }}</th>
  <th>{{ $table->total_unfulfilled_factor_yes_before }}</th>
  <th>{{ $table->total_factor_no }}</th>
  <th>{{ $table->total_executed_factor_no }}</th>
  <th>{{ $table->total_unfulfilled_factor_no }}</th>
  <th>{{ $table->rating }}</th>
  <th>{{ $table->array_unfulfilled_json_from }}</th>
</tr>
@endforeach
</tbody>
</table>
</div>
@if (count($prof_all_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым выполняются все условия</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_all_conditions as  $prof_all_condition)
<tr>
  <th>{{ $prof_all_condition->rating }}</th>
  <th>{{ $prof_all_condition->prof_title }}</th>
  <th>{{ $prof_all_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_1_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 1 теме должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_1_conditions as  $prof_no_1_condition)
<tr>
  <th>{{ $prof_no_1_condition->rating }}</th>
  <th>{{ $prof_no_1_condition->prof_title }}</th>
  <th>{{ $prof_no_1_condition->theme_num }}</th>
  <th>{{ $prof_no_1_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_2_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 2 темам должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_2_conditions as  $prof_no_2_condition)
<tr>
  <th>{{ $prof_no_2_condition->rating }}</th>
  <th>{{ $prof_no_2_condition->prof_title }}</th>
  <th>{{ $prof_no_2_condition->theme_num }}</th>
  <th>{{ $prof_no_2_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_3_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 3 темам должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_3_conditions as  $prof_no_3_condition)
<tr>
  <th>{{ $prof_no_3_condition->rating }}</th>
  <th>{{ $prof_no_3_condition->prof_title }}</th>
  <th>{{ $prof_no_3_condition->theme_num }}</th>
  <th>{{ $prof_no_3_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_4_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 4 темам должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_4_conditions as  $prof_no_4_condition)
<tr>
  <th>{{ $prof_no_4_condition->rating }}</th>
  <th>{{ $prof_no_4_condition->prof_title }}</th>
  <th>{{ $prof_no_4_condition->theme_num }}</th>
  <th>{{ $prof_no_4_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_5_conditions) > 0)
<hr>

<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 5 темам должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_5_conditions as  $prof_no_5_condition)
<tr>
  <th>{{ $prof_no_5_condition->rating }}</th>
  <th>{{ $prof_no_5_condition->prof_title }}</th>
  <th>{{ $prof_no_5_condition->theme_num }}</th>
  <th>{{ $prof_no_5_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@if (count($prof_no_6_conditions) > 0)
<hr>
<div class="content-body"><!-- stats -->


<table class="table table-hover">
<thead>
<tr>
  <th>Рейтинг</th>
  <th>Профессии, по которым Ваш результат по 6 темам должен быть немного выше.</th>
  <th>Номера этих тем</th>
  <th>Ранг профессии</th>
  


</tr>
</thead>
<tbody>
  @foreach ($prof_no_6_conditions as  $prof_no_6_condition)
<tr>
  <th>{{ $prof_no_6_condition->rating }}</th>
  <th>{{ $prof_no_6_condition->prof_title }}</th>
  <th>{{ $prof_no_6_condition->theme_num }}</th>
  <th>{{ $prof_no_6_condition->prof_level }}</th>
  
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
@endsection
