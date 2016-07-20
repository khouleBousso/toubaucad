<!DOCTYPE html>
<html ng-app="appAdmin">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Gestion Touba UCAD</title>

        <meta name="description"
              content="Dynamic tables and grids using jqGrid plugin" />
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.css" />

        <!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/dropzone.css" />
        <link rel="stylesheet" href="assets/css/jquery-ui.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" href="assets/css/colorpicker.css" />
        <link rel="stylesheet" href="assets/css/chosen.css" />
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/css/fullcalendar.css" />
        <!-- text fonts -->
        <link rel="stylesheet" href="assets/css/ace-fonts.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="assets/css/loading-bar.css">
        <link rel="stylesheet" href="lib/angular-growl.css" />
        <link rel="stylesheet" href="public/css/projet.css" />
        <script src="lib/jquery.min.js"></script>
        <!-- ace settings handler -->
        <script src="lib/conf.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/chosen.jquery.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datepicker.js"></script>
        <script src="assets/js/date-time/daterange-fr.js"></script>
        <script src="assets/js/date-time/moment.js"></script>
        <script src="assets/js/date-time/daterangepicker.js"></script>
        <script src="assets/js/date-time/bootstrap-datetimepicker.js"></script>
        <script src="lib/angular.min.js"></script>
        <script type="text/javascript" src="controllers/app.js"></script>
        <script type="text/javascript" src="controllers/user.js"></script>
        <script type="text/javascript" src="controllers/login.js"></script>
        <script type="text/javascript" src="services/auth.js"></script>
        <script type="text/javascript" src="controllers/routingConfig.js"></script>
        <script type="text/javascript" src="directives/access-level-admin.js"></script>
        <script src="lib/angular-ressource.min.js"></script>
        <script src="lib/angular-ui-router.min.js"></script>
        <script src="lib/angular-cookies.min.js"></script>
        <script src="lib/jquery.dataTables.min.js"></script>
        <script src="lib/angular-datatables.min.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        
        <script src="lib/angular-growl.js"></script>
        <script src="assets/js/loading-bar.js"></script>
        <script src="assets/js/fullcalendar.js"></script>

        <script src="assets/js/jquery.maskedinput.js"></script>
          <!-- page specific plugin scripts -->
           <script src="assets/js/ace/elements.fileinput.js"></script>
    </head>

    <body ng-class="{ 'login-layout blur-login': isPageLogin , 'no-skin': !isPageLogin  }">
        <!-- #section:basics/navbar.layout -->
        <!-- la  barre de navigation -->
        <div ng-show="!isPageLogin">
            <bare-navigation></bare-navigation>
        </div>
        <!-- /section:basics/navbar.layout -->

        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <!-- #section:basics/sidebar -->
            <div ng-show="!isPageLogin" id="sidebar" class="sidebar responsive">
                <ng-include src="'menu.php'"></ng-include>
            </div>

            <!-- /section:basics/sidebar -->
            <div class="main-content">
                <div class="main-content-inner">
                    <div growl></div>
                    <div ui-view></div>
                </div>
            </div>
            <!-- /.main-content -->
            <div ng-show="!isPageLogin" class="footer">
                <footer></footer>
            </div>
            <a href="#" id="btn-scroll-up"
               class="btn-scroll-up btn btn-sm btn-inverse"> <i
                    class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.js"></script>


        <!-- ace scripts -->
        <script src="assets/js/ace/ace.js"></script>
        <script type="text/javascript"> ace.vars['base'] = '..';</script>
        <script src="assets/js/flot/jquery.flot.js"></script>
        <script src="assets/js/flot/jquery.flot-categories.js"></script>
        <script src="assets/js/flot/jquery.flot.pie.js"></script>
        <script src="assets/js/flot/jquery.flot.resize.js"></script>
    </body>
</html>