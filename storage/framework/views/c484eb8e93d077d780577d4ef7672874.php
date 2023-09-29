
<?php $__env->startSection('content'); ?>
    <form method="GET" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Id :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($profile['id']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Name :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($profile['first_name']." ".$profile['last_name']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Active :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($profile['active']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Gender :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($profile['gender']); ?>

                </div>
            </div>
           
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Email :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($profile['email']); ?>

                </div>
            </div>
            <button type="submit" >Logout</button>
        </div>
    </form>
    


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/profile.blade.php ENDPATH**/ ?>