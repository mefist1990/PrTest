<?php $__env->startSection('content'); ?>
<div class="content-body"><!-- stats -->





<section id="basic-listgroup">
  <div class="row match-height">
    <div class="col-lg-6 col-md-12">
      <div class="card" style="height: 378px;">
        <div class="card-header">





<?php if($counter <= $issues_result): ?>

<h4 class="card-title">Вопрос <?php echo $counter; ?> / <?php echo $issues_result; ?></h4>
<?php else: ?>
<h4 class="card-title">Вопросов нет</h4>
<?php endif; ?>

          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">

          </div>
        </div>
        <div class="card-body collapse in">
          <div class="card-block">
<?php if($counter <= $issues_result): ?>
<p><?php echo $issues->description; ?></p>
<?php else: ?>
<p>Воросов больше нет</p>
<?php endif; ?>


<?php if($counter <= $issues_result): ?>

<form action="back" name="myform">
      <div class="btn-toolbar" role="toolbar" style="margin: 0;">
      <div class="btn-group">
                  <button type="submit" class="btn list-group-item btn-group-sm" name="answer" value="back" disabled="disabled">Назад</button>
                  <input type="hidden" name="issues_id" value="<?php echo $issues->id; ?>">
                  <input type="hidden" name="counter" value="<?php echo $counter; ?>">
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
</div>


                  <input type="hidden" name="issues_id" value="<?php echo $issues->id; ?>">
                  <input type="hidden" name="counter" value="<?php echo $counter; ?>">

</form>


<?php endif; ?>


          </div>
        </div>
      </div>
    </div>

  </div>
</section>



</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>