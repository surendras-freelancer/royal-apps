<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            function logout(){
                window.location.href="<?php echo e(route('logout')); ?>";
            }
            function profile(){
                window.location.href="<?php echo e(route('profile')); ?>";
            }
            function view_author(id){
                window.location.href="authors/"+id;
            }
           
            $(document).ready(function(){
                $(".login-container,.card").hover(function(){
                    $(".card").show();
                }, function() {
                    $(".card").hide();
                });
            });
            
        </script>
    </head>
<body>
    <?php if(in_array(Route::currentRouteName(), ['index', 'login'])): ?>
    <?php else: ?>
    <div class="topnav">
        <a class="active" href="<?php echo e(route('authors')); ?>">Authors List</a>
        <a class="" href="<?php echo e(route('addBook')); ?>">Add Book</a>
        <div class="login-container" >
            <a href="#" ><i class="fa fa-fw fa-user"></i> </a>
            <!--  -->
        </div>
    </div>
        
    <div class="card" style="display:none;">
        <h1><?php echo e(session('user_name')); ?></h1>
        <button type="button" onclick="profile()" style="background-color:#000;">Profile</button>
        <button type="button" onclick="logout()" style="background-color:#000;">Logout</button>
    </div>
    <?php endif; ?>
    <h1 class="text-center"><?php echo e($page_title); ?> </h1>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\candidate-app\resources\views/layouts/default.blade.php ENDPATH**/ ?>