 <div class="dropdown ms-sm-3 header-item topbar-user">
     <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
         aria-expanded="false">
         <span class="d-flex align-items-center">
             <img class="rounded-circle header-profile-user" src="<?php echo e(currentUser()->img); ?>" alt="Header Avatar" />
             <span class="text-start ms-xl-2">
                 <span
                     class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(currentUser()->first_name ?? ''); ?>

                 </span>
                 <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"><?php echo e(currentUser()->designation ?? ''); ?>

                 </span>
             </span>
         </span>
     </button>
     <div class="dropdown-menu dropdown-menu-end">
         <!-- item-->
         <h6 class="dropdown-header">Welcome <?php echo e(currentUser()->first_name ?? ''); ?>!</h6>
         


         
         
         <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
             <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
             <span class="align-middle" data-key="t-logout">Logout</span>
         </a>
         


     </div>
 </div>

 
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/layout/include/user-profile.blade.php ENDPATH**/ ?>