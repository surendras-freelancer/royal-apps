
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
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Id :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($author['id']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Name :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($author['first_name']." ".$author['last_name']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Birthday :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($author['birthday']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Gender :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($author['gender']); ?>

                </div>
            </div>
           
            <div class="row">
                <div class="col-md-4 text-bold">
                    <label for="uname">Place of Birth :</label>
                </div>
                <div class="col-md-8">
                    <?php echo e($author['place_of_birth']); ?>

                </div>
            </div>
            <?php if(empty($author['books'])): ?>
                <button type="button" class="delete-author"  >Delete Author</button>
            <?php endif; ?>
            <button type="submit" style="visibility:hidden;">Login</button>
        </div>
    </form>
    <h2>Author Book List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Release Date</th>
                <th>Description</th>
                <th>Isbn</th>
                <th>Format</th>
                <th>No. of Pages</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $author['books']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-books-id="<?php echo e($book['id']); ?>">
                    <td><?php echo e($book['id']); ?></td>
                    <td><?php echo e($book['title']); ?></td>
                    <td><?php echo e($book['release_date']); ?></td>
                    <td><?php echo e($book['description']); ?></td>
                    <td><?php echo e($book['isbn']); ?></td>
                    <td><?php echo e($book['format']); ?></td>
                    <td><?php echo e($book['number_of_pages']); ?></td>
                    <td><button type="button"  class="delete-button" data-book-id="<?php echo e($book['id']); ?>">Delete</button></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-author').click(function() {
            if (confirm('Are you sure you want to delete this author?')) {
                window.location.href="/delete-author/<?php echo e($author['id']); ?>";
            }
        });

        $('.delete-button').click(function() {
            const book_id = $(this).data('book-id');
            if (confirm('Are you sure you want to delete this Book?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/api/books/' + book_id, //
                    success: function(data) {
                        if(data.message == 'Success') {
                            $(`tr[data-books-id="${book_id}"]`).remove();
                        }else{
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Failed to delete book. Please try again.');
                    }
                });
            }
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/single-author.blade.php ENDPATH**/ ?>