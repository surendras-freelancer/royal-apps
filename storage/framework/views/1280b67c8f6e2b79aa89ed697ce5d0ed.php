
<?php $__env->startSection('content'); ?>

<?php if(session('error')): ?>
    <p style="color: red"><?php echo e(session('error')); ?></p>
<?php endif; ?>
<?php if(session('success')): ?>
    <p style="color: green"><?php echo e(session('success')); ?></p>
<?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Place of Birth</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $authors['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($author['id']); ?></td>
                    <td><?php echo e($author['first_name']." ".$author['last_name']); ?></td>
                    <td><?php echo e($author['birthday']); ?></td>
                    <td><?php echo e($author['gender']); ?></td>
                    <td><?php echo e($author['place_of_birth']); ?></td>
                    <td><button type="button" onclick="view_author(<?php echo e($author['id']); ?>)">View</button></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/authors.blade.php ENDPATH**/ ?>