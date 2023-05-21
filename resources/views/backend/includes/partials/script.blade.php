   
   
   {{-- External jquery File Loaded here.. --}}
   <script src="{{ asset('') }}backend/custom/datatable/js/jquery-3.5.1.js"></script>

   <!-- BEGIN: Vendor JS-->
   <script src="{{ asset('') }}backend/app-assets/vendors/js/vendors.min.js"></script>
   <!-- BEGIN Vendor JS-->

   <!-- BEGIN: Page Vendor JS-->
   <script src="{{ asset('') }}backend/app-assets/vendors/js/extensions/moment.min.js"></script>

   {{-- Data Fether Loading... --}}
 <!--   <script>
       $(window).on('load', function() {
           if (feather) {
               feather.replace({
                   width: 14,
                   height: 14
               });
           }
       })
   </script> -->

   <!-- DataTables -->
   <script src="{{ asset('') }}backend/custom/datatable/js/jquery.dataTables.min.js"></script>
   <script src="{{ asset('') }}backend/custom/datatable/js/dataTables.bootstrap4.min.js"></script>
   <script src="{{ asset('') }}backend/custom/datatable/js/dataTables.responsive.min.js"></script>
   <script src="{{ asset('') }}backend/custom/datatable/js/responsive.bootstrap4.min.js"></script>

   {{-- Date picker... --}}
   <script src="{{ asset('') }}backend/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
   <script src="{{ asset('') }}backend/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
   <script src="{{ asset('') }}backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

   {{-- Multiple slect optino... --}}
   <script src="{{ asset('') }}backend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>

   <!-- END: Page Vendor JS-->

   <!-- BEGIN: Theme JS-->
   <script src="{{ asset('') }}backend/app-assets/js/core/app-menu.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/core/app.js"></script>
   <!-- END: Theme JS-->

   <!-- BEGIN: Page JS-->
   <script src="{{ asset('') }}backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/pages/page-auth-login.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/forms/form-select2.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/forms/form-validation.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/pages/app-user-edit.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/pages/page-profile.js"></script>
   <script src="{{ asset('') }}backend/app-assets/js/scripts/pages/page-account-settings.js"></script>
   <!-- END: Page JS-->

   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
   {!! Toastr::message() !!}

   <script>
       $(document).ready(function() {
           $('#myTable').DataTable();
       });
   </script>
