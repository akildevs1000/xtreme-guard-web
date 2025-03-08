  <!-- removeNotificationModal -->
  <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                      id="NotificationModalbtn-close"></button>
              </div>
              <div class="modal-body">
                  <div class="mt-2 text-center">
                      
                      <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                          <h4>Are you sure ?</h4>
                          <p class="text-muted mx-4 mb-0">
                              Are you sure you want to remove this Notification ?
                          </p>
                      </div>
                  </div>
                  <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                      <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">
                          Close
                      </button>
                      <button type="button" class="btn w-sm btn-danger" id="delete-notification">
                          Yes, Delete It!
                      </button>
                  </div>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- ========== App Menu ========== -->
  <div class="app-menu navbar-menu">
      <!-- LOGO -->
      <div class="navbar-brand-box">
          <!-- Dark Logo-->
          <a href="index.html" class="logo logo-dark">
              <span class="logo-sm">
                  <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22" />
              </span>
              <span class="logo-lg">
                  <img src="<?php echo e(asset('assets/images/logo-dark.png')); ?>" alt="" height="17" />
              </span>
          </a>
          <!-- Light Logo-->
          <a href="index.html" class="logo logo-light">
              <span class="logo-sm">
                  <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22" />
              </span>
              <span class="logo-lg">
                  <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="" height="17" />
              </span>
          </a>
          <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
              id="vertical-hover">
              <i class="ri-record-circle-line"></i>
          </button>
      </div>

      <div id="scrollbar">
          <div class="container-fluid">
              <div id="two-column-menu"></div>
              <ul class="navbar-nav" id="navbar-nav">
                  <?php
                      $headerMenuData = menu();
                      $headerMenu = $headerMenuData['HeaderMenu'];
                      $detailMenu = $headerMenuData['DetailMenu'];
                      $subMenuDetail = $headerMenuData['SubMenuDetail'];
                  ?>

                  <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                  <?php for($i = 0; $i < count($headerMenu); $i++): ?>
                      <?php if($headerMenu[$i]->id == 1): ?>
                          <li class="nav-item">
                              <a class="nav-link menu-link" href="<?php echo e(url('admin/dashboard')); ?>" role="button"
                                  aria-expanded="false" aria-controls="sidebarDashboards">
                                  <i class="ri-dashboard-2-line"></i>
                                  <span data-key="t-dashboards"><?php echo e($headerMenu[$i]->name1 ?? ''); ?></span>
                              </a>
                          </li>
                      <?php else: ?>
                          <li class="nav-item">
                              <a class="nav-link menu-link fs-13" href="#<?php echo e(strtolower($headerMenu[$i]->name1)); ?>"
                                  data-bs-toggle="collapse" role="button" aria-expanded="false"
                                  aria-controls="sidebarApps">
                                  <i class="<?php echo e($headerMenu[$i]->icon); ?>"></i>
                                  <span data-key="t-<?php echo e($headerMenu[$i]->name1); ?>"><?php echo e($headerMenu[$i]->name1); ?></span>
                              </a>

                              <div class="collapse menu-dropdown" id="<?php echo e(strtolower($headerMenu[$i]->name1)); ?>">
                                  <ul class="nav nav-sm flex-column" styles=" width: max-content; ">
                                      <?php for($j = 0; $j < count($detailMenu); $j++): ?>
                                          <?php if($headerMenu[$i]->id == $detailMenu[$j]->menu_header_id): ?>
                                              <?php if(!$detailMenu[$j]->is_submenu_available): ?>
                                                  <li class="nav-item">
                                                      <a href="<?php echo e(url($detailMenu[$j]->page_url)); ?>"
                                                          class="nav-link fs-12" data-key="t-analytics"
                                                          style="white-space: nowrap;">
                                                          <i class="<?php echo e($detailMenu[$j]->icon); ?>"></i>
                                                          <?php echo e($detailMenu[$j]->name1); ?>

                                                      </a>
                                                  </li>
                                              <?php else: ?>
                                                  <li class="nav-item">
                                                      <a href="#<?php echo e(strtolower($detailMenu[$j]->name1)); ?>"
                                                          class="nav-link fs-12" data-bs-toggle="collapse"
                                                          role="button" aria-expanded="false"
                                                          aria-controls="sidebarCalendar" style="white-space: nowrap;"
                                                          data-key="t-<?php echo e(strtolower($detailMenu[$j]->name1)); ?>">
                                                          <i class="<?php echo e($detailMenu[$j]->icon); ?>"></i>
                                                          <?php echo e($detailMenu[$j]->name1); ?>

                                                      </a>
                                                      <div class="collapse menu-dropdown"
                                                          id="<?php echo e(strtolower($detailMenu[$j]->name1)); ?>"
                                                          styles=" width: max-content; ">
                                                          <ul class="nav nav-sm flex-column">
                                                              <?php for($k = 0; $k < count($subMenuDetail); $k++): ?>
                                                                  <?php if($detailMenu[$j]->id == $subMenuDetail[$k]->menu_detail_id): ?>
                                                                      <li class="nav-item">
                                                                          <a href="<?php echo e(url($subMenuDetail[$k]->page_url)); ?>"
                                                                              style="white-space: nowrap;"
                                                                              class="nav-link fs-12"
                                                                              data-key="t-main-<?php echo e(strtolower($subMenuDetail[$k]->name1)); ?>">
                                                                              <i
                                                                                  class="<?php echo e($subMenuDetail[$k]->icon); ?>"></i>
                                                                              <?php echo e($subMenuDetail[$k]->name1); ?>

                                                                          </a>
                                                                      </li>
                                                                  <?php endif; ?>
                                                              <?php endfor; ?>
                                                          </ul>
                                                      </div>
                                                  </li>
                                              <?php endif; ?>
                                          <?php endif; ?>
                                      <?php endfor; ?>
                                  </ul>
                              </div>
                          </li>
                      <?php endif; ?>
                  <?php endfor; ?>
                  <!-- end Dashboard Menu -->
              </ul>
          </div>
      </div>
      <!-- Sidebar -->
      <div class="sidebar-background"></div>
  </div>

  <!-- Left Sidebar End -->
  <!-- Vertical Overlay-->
  <div class="vertical-overlay"></div>
<?php /**PATH D:\Install\laragon\www\akil\resources\views/components/layout/nav-menu.blade.php ENDPATH**/ ?>