@extends('layouts.new')

@section('content')
<div class="content-body"><!-- stats -->
  <p> 
  	Ваша профессия - <h3>{{ $professions[0]->prof_title }}</h3> 
  	Количество выполненных требований - <h3>{{ $professions[0]->total_executed}}</h3>
  	Количество не выполненных требований - <h3>{{ $professions[0]->total_unfulfilled}}</h3>

  	Общее количество требований - <h3>{{ $professions[0]->total}}</h3>
  	Количество выполненных обязательных требований factor = yes - <h3>{{ $professions[0]->total_executed_factor_yes}}</h3>
  	Количество выполненных не обязательных требований factor = no - <h3>{{ $professions[0]->total_executed_factor_no}}</h3>
  	Количество не выполненных обязательных требований factor = yes - <h3>{{ $professions[0]->total_unfulfilled_factor_yes}}</h3>
  	Количество не выполненных не обязательных требований factor = no - <h3>{{ $professions[0]->total_unfulfilled_factor_no}}</h3>
  	


  </p>
<table class="table table-hover">
<thead>
<tr>
  <th>user_id (id пользователя)</th>
  <th>prof_id (id профессии)</th>
  <th>prof_title (Название професси)</th>
  <th>total_executed (Количество выполненных требований)</th>
  <th>total_unfulfilled (Количество не выполненных требований)</th>
  <th>total_total (Общее количество требований)</th>
  <th>total_executed_factor_yes (Количество выполненных обязательных требований factor = yes)</th>
  <th>total_executed_factor_no (Количество выполненных не обязательных требований factor = no)</th>
  <th>total_executed_factor_yes_before (Количество выполненных обязательных требований ДО factor = yes && from = 0)</th>
  <th>total_unfulfilled_factor_yes (Количество не выполненных обязательных требований factor = yes)</th>
  <th>total_unfulfilled_factor_no (Количество не выполненных не обязательных требований factor = no)</th>
  <th>total_unfulfilled_factor_yes_before (Количество не выполненных обязательных требований ДО factor = yes && from = 0)</th>
  <th>total_unfulfilled_factor_yes_from (Количество не выполненных обязательных требований ОТ factor = yes && from != 0)</th>
  <th>array_unfulfilled_json_from (Номера тем, по которым не выполняются обязательные ограничения ОТ)</th>

</tr>
</thead>
<tbody>
  @foreach ($tables as $table)
<tr>
  <td>{{ $table->user_id }}</td>
  <td>{{ $table->prof_id }}</td>
  <td>{{ $table->prof_title }}</td>
  <td>{{ $table->total_executed }}</td>
  <td>{{ $table->total_unfulfilled }}</td>
  <td>{{ $table->total }}</td>
  <td>{{ $table->total_executed_factor_yes }}</td>
  <td>{{ $table->total_executed_factor_no }}</td>
  <td>{{ $table->total_executed_factor_yes_before }}</td>
  <td>{{ $table->total_unfulfilled_factor_yes }}</td>
  <td>{{ $table->total_unfulfilled_factor_no }}</td>
  <td>{{ $table->total_unfulfilled_factor_yes_before }}</td>
  <td>{{ $table->total_unfulfilled_factor_yes_from }}</td>
  <td>{{ $table->array_unfulfilled_json_from }}</td>


</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
