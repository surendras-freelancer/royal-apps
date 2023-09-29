
<?php $__env->startSection('content'); ?>

        <?php if(session('error')): ?>
            <p style="color: red"><?php echo e(session('error')); ?></p>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <p style="color: green"><?php echo e(session('success')); ?></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('addBookSubmit')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="container">
                <label for="author">Author:</label>
                <select name="author" id="author">
                <?php $__currentLoopData = $authors['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($author['id']); ?>"><?php echo e($author['first_name']." ".$author['last_name']); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <br><br>

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            
                <label for="isbn">Isbn:</label>
                <input type="text" name="isbn" id="isbn" required>

                <label for="format">Format:</label>
                <input type="text" name="format" id="format" required>

                <label for="number_of_pages">No. of Pages:</label>
                <input type="text" name="number_of_pages" id="number_of_pages" required>
                
                <label for="release_date">Relase Date:</label>
                <input type="date" name="release_date" id="release_date" required>
                <br><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            
                <button type="submit">Add</button>
            </div>
        </form>
    </body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/add-book.blade.php ENDPATH**/ ?>