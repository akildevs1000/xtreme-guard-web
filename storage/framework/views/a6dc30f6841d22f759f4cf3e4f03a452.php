<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        

                        <div class="col-lg-12">
                            <div class="p-lg-5 p-4">
                                <div>
                                    <h5 class="text-primary">Other Logged Devices</h5>
                                    <p class="text-muted">Manage and logout your active login status on ther devices!
                                    </p>
                                </div>
                                <div class="user-thumb text-center">
                                    <img src="<?php echo e($user->img ?? ''); ?>" class="rounded-circle img-thumbnail avatar-lg"
                                        alt="thumbnail">
                                    <h5 class="mt-3"><?php echo e($user->username ?? ''); ?></h5>
                                </div>

                                <div class="mt-4 mb-3 border-bottom pb-2">
                                    <div class="float-end">
                                        
                                    </div>
                                    <h5 class="card-title">Login History</h5>
                                </div>

                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 avatar-sm">
                                        <div class="avatar-title bg-light text-primary rounded-3" style="font-size:30px">
                                            <i class="<?php echo e(getDeviceIcon($logedDevice->device)); ?>"></i>
                                        </div>
                                    </div>
                                    <?php if(!empty($logedDevice)): ?>
                                        <div class="flex-grow-1 mx-3"style=" border-right:1px solid #e9ebec;">
                                            <h6><?php echo e($logedDevice->device); ?></h6>
                                            <p class="text-muted mb-0">
                                                User logged in successfully using
                                                <b><?php echo e($logedDevice->browser ?? ''); ?></b>
                                                on a running
                                                <b><?php echo e($logedDevice->os); ?></b>
                                                <b>
                                                    <?php echo e(date('F j \a\t g:i A', strtotime($logedDevice->login_time))); ?>

                                                </b>
                                                from
                                                the IP address <b><?php echo e($logedDevice->ip_address); ?></b>
                                            </p>
                                        </div>
                                        <div>
                                            <a href="#" class="text-danger" title="Logout"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="ri-lock-unlock-line fs-20"></i>
                                            </a>

                                            <form id="logout-form"
                                                action="<?php echo e(url('reset-login-session', ['username' => $user->username])); ?>"
                                                method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                            </form>

                                        </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    No users are currently logged in.
                                </div>
                                <?php endif; ?>
                                <div class="mt-5 text-center">
                                    <p class="mb-0">Not you ? return <a href="<?php echo e(url('login')); ?>"
                                            class="fw-semibold text-primary text-decoration-underline"> Signin</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->startPush('scripts'); ?>
        <script>
            function submitResetSession() {
                let username = document.getElementById('username').value;
                if (username == '') {
                    alert('Please enter username');
                    return;
                }
                window.location.href = '<?php echo e(url('reset-login-session')); ?>';
            }
        </script>
    <?php $__env->stopPush(); ?>

    <style>
        @media (min-width: 1200px) {
            :is(.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl) {
                max-width: 800px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/auth/reset-user-session.blade.php ENDPATH**/ ?>