<?php $__env->startSection('content'); ?>
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

    <a href="<?php echo e(URL::to('DiaryTestsDownloadExcel/xls')); ?>"><button class="btn btn-success">Скачать Excel xls</button></a>
    <a href="<?php echo e(URL::to('DiaryTestsDownloadExcel/xlsx')); ?>"><button class="btn btn-success">Скачать Excel xlsx</button></a>
    <a href="<?php echo e(URL::to('DiaryTestsDownloadExcel/csv')); ?>"><button class="btn btn-success">Скачать CSV</button></a>


          </div>




          </div>
        </div>
      </div>
    </div>

  </div>
</section>



</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>