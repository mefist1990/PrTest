

<?php $__env->startSection('content'); ?>
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
  <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($key+1); ?></th>
  <th><?php echo e($table->prof_title); ?></th>
  <th><?php echo e($table->total_factor_yes_from); ?></th>
  <th><?php echo e($table->total_executed_factor_yes_from); ?></th>
  <th><?php echo e($table->total_unfulfilled_factor_yes_from); ?></th>
  <th><?php echo e($table->total_factor_yes_before); ?></th>
  <th><?php echo e($table->total_executed_factor_yes_before); ?></th>
  <th><?php echo e($table->total_unfulfilled_factor_yes_before); ?></th>
  <th><?php echo e($table->total_factor_no); ?></th>
  <th><?php echo e($table->total_executed_factor_no); ?></th>
  <th><?php echo e($table->total_unfulfilled_factor_no); ?></th>
  <th><?php echo e($table->rating); ?></th>
  <th><?php echo e($table->array_unfulfilled_json_from); ?></th>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php if(count($prof_all_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_all_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_all_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_all_condition->rating); ?></th>
  <th><?php echo e($prof_all_condition->prof_title); ?></th>
  <th><?php echo e($prof_all_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_1_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_1_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_1_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_1_condition->rating); ?></th>
  <th><?php echo e($prof_no_1_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_1_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_1_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_2_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_2_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_2_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_2_condition->rating); ?></th>
  <th><?php echo e($prof_no_2_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_2_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_2_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_3_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_3_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_3_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_3_condition->rating); ?></th>
  <th><?php echo e($prof_no_3_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_3_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_3_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_4_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_4_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_4_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_4_condition->rating); ?></th>
  <th><?php echo e($prof_no_4_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_4_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_4_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_5_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_5_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_5_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_5_condition->rating); ?></th>
  <th><?php echo e($prof_no_5_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_5_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_5_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php if(count($prof_no_6_conditions) > 0): ?>
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
  <?php $__currentLoopData = $prof_no_6_conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prof_no_6_condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <th><?php echo e($prof_no_6_condition->rating); ?></th>
  <th><?php echo e($prof_no_6_condition->prof_title); ?></th>
  <th><?php echo e($prof_no_6_condition->theme_num); ?></th>
  <th><?php echo e($prof_no_6_condition->prof_level); ?></th>
  
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>