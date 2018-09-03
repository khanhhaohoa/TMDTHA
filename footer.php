        <footer class="footer">
                    2018 © <span class="hide-phone">HAI ANH GROUP</span>
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <script src="<?php echo style; ?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="<?php echo style; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/detect.js"></script>
        <script src="<?php echo style; ?>/assets/js/fastclick.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo style; ?>/assets/js/waves.js"></script>
        <script src="<?php echo style; ?>/assets/js/wow.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/switchery/switchery.min.js"></script>

        <!-- Counter Up  -->
        <script src="<?php echo style; ?>/assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="<?php echo style; ?>/assets/plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="<?php echo style; ?>/assets/plugins/skyicons/skycons.min.js" type="text/javascript"></script>

        <!-- Page js  -->
        <script src="<?php echo style; ?>/assets/pages/jquery.dashboard.js"></script>

        <!-- Custom main Js -->
        <script src="<?php echo style; ?>/assets/js/jquery.core.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.app.js"></script>

        <!-- Table -->
                <!-- Required datatable js -->
        <script src="<?php echo style; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.select.min.js"></script>
        <!-- Examples -->
        <script src="<?php echo style; ?>/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/tiny-editable/numeric-input-example.js"></script>
        <!-- Dropzone js -->
        <script src="<?php echo style; ?>/assets/plugins/dropzone/dropzone.js"></script>

        <!-- Modal-Effect -->
        <script src="<?php echo style; ?>/assets/plugins/custombox/dist/custombox.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/custombox/dist/legacy.min.js"></script>
        <script src="<?php echo style; ?>/assets/pages/datatables.editable.init.js"></script>

        <script>
            $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
        </script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $('.circliful-chart').circliful();
            });

            // BEGIN SVG WEATHER ICON
            if (typeof Skycons !== 'undefined'){
                var icons = new Skycons(
                        {"color": "#3bafda"},
                        {"resizeClear": true}
                        ),
                        list  = [
                            "clear-day", "clear-night", "partly-cloudy-day",
                            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                            "fog"
                        ],
                        i;

                for(i = list.length; i--; )
                    icons.set(list[i], list[i]);
                icons.play();
            };

        </script>




    </body>
</html>