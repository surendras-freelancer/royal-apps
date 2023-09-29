
<?php $__env->startSection('content'); ?>

        <?php if(session('error')): ?>
            <p style="color: red"><?php echo e(session('error')); ?></p>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <p style="color: green"><?php echo e(session('success')); ?></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="container">
                <label for="uname">Email:</label>
                <input type="text" name="uname" id="uname" required>
            
                <label for="psw">Password:</label>
                <input type="password" name="psw" id="psw" required>
            
                <button type="submit">Login</button>
            </div>
        </form>
    </body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/login.blade.php ENDPATH**/ ?>