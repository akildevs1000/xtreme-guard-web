   @props([
       'titleName' => '',
       'idName' => '',
       'size' => 'modal-lg',
   ])

   <div class="modal fade zoomIn" id="{{ $idName }}" tabindex="-1" aria-labelledby="{{ $idName }}Label"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered {{ $size }}" {{ $attributes->merge() }}>
           <div class="modal-content border-0">
               <div class="modal-header p-3 bg-info-subtle">
                   <h5 class="modal-title" id="{{ $idName }}Label">{{ $titleName }}</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal">
                   </button>
               </div>
               <div class="modal-body">

                   <div class="text-center align-items-center justify-content-center position-absolute top-0 bottom-0 start-0 end-0 bg-white"
                       id="dlg-loader-spin" style="font-size: 60px;z-index: 99;display:flex; height:100%">
                       <i class="fa fa-spinner mb-2 i fa-spin"></i>
                   </div>

                   {{-- <div class="loading-spinner mb-2"></div>
                   <div>Loading</div> --}}

                   {{ $slot }}
               </div>
               <div class="modal-footer">
                   <div class="hstack gap-2 justify-content-end">
                       <button type="button" class="btn btn-light" id="close-modal"
                           data-bs-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>
   </div>


   <style>
       .loading-spinner {
           width: 30px;
           height: 30px;
           border: 2px solid indigo;
           border-radius: 50%;
           border-top-color: #0001;
           display: inline-block;
           animation: loadingspinner .7s linear infinite;
       }

       @keyframes loadingspinner {
           0% {
               transform: rotate(0deg)
           }

           100% {
               transform: rotate(360deg)
           }
       }
   </style>
