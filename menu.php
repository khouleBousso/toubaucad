<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'fixed')
    } catch (e) {
    }

    function ouvrirmenu(tab1, tab2, tab3, tab4,tab5) {

        var btn = $("#" + tab1).removeClass("active").addClass('active');
        var btn = $("#" + tab2).removeClass("active");
        var btn = $("#" + tab3).removeClass("active");
        var btn = $("#" + tab4).removeClass("active");
        var btn = $("#" + tab5).removeClass("active");
    }


</script>

<div ng-controller="MainCtrl">
    <ul class="nav nav-list" data-access-level-cheikh>
        <li class="active" id="idaccueil">
            <a  ng-href="#/accueil" onclick="ouvrirmenu('idaccueil', 'idmembres', 'idndigueuls', 'idkurels','idarchive')">
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil</span>
            </a>

            <b class="arrow"></b>
        </li>
        <li id="idmembres">
            <a  ng-href="#/membres" onclick="ouvrirmenu('idmembres', 'idaccueil', 'idndigueuls', 'idkurels','idarchive')">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Dieuwrignes</span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li id="idndigueuls">
            <a  ng-href="#/ndigueuls" onclick="ouvrirmenu('idndigueuls', 'idaccueil', 'idmembres', 'idkurels','idarchive')">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Ndigueuls en cours</span>
            </a>

            <b class="arrow"></b>
        </li>
        
        <li id="idkurels">
            <a  ng-href="#/kurels" onclick="ouvrirmenu('idkurels', 'idndigueuls', 'idaccueil', 'idmembres','idarchive')">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Daaras</span>
            </a>

            <b class="arrow"></b>
        </li>
        <li id="idarchive">
            <a class="dropdown-toggle" href="#" onclick="ouvrirmenu('idarchive', 'idkurels', 'idndigueuls', 'idaccueil', 'idmembres')">
                <i class="menu-icon fa fa-caret-right"></i>
                Archive
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu nav-show" style="display: block;">
                <li class="" id="idfichepre">
                    <a href="#/ndigueuls-archive" >
                        <i class="menu-icon fa fa-caret-right"></i>
                        Ndigueuls archiv&eacute;s
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

    </ul>
     <ul class="nav nav-list" data-access-level-dieuwrigne-daara>
        <li class="active" id="idaccueil">
            <a  ng-href="#/kurel/{{user.id_kurel}}" >
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil</span>
            </a>

            <b class="arrow"></b>
        </li>

         <li id="idndigueuls">
             <a  ng-href="#/ndigueuls" onclick="ouvrirmenu('idndigueuls', 'idaccueil', 'idmembres', 'idkurels','idarchive')">
                 <i class="menu-icon fa fa-list-alt"></i>
                 <span class="menu-text"> Ndigueuls en cours</span>
             </a>

             <b class="arrow"></b>
         </li>

         <li id="idarchive">
             <a class="dropdown-toggle" href="#" onclick="ouvrirmenu('idarchive', 'idkurels', 'idndigueuls', 'idaccueil', 'idmembres')">
                 <i class="menu-icon fa fa-caret-right"></i>
                 Archive
                 <b class="arrow fa fa-angle-down"></b>
             </a>

             <b class="arrow"></b>

             <ulclass="submenu nav-show" style="display: block;">
                 <li class="" id="idfichepre">
                     <a href="#/ndigueuls-archive" >
                         <i class="menu-icon fa fa-caret-right"></i>
                         Ndigueuls archiv&eacute;s
                     </a>

                     <b class="arrow"></b>
                 </li>
             </ul>
         </li>

    </ul>
    
     <ul class="nav nav-list" data-access-level-thiantacone>
        <li class="active" id="idaccueil">
            <a  ng-href="#/kurel/{{user.id_kurel_member}}" >
                <i class="menu-icon fa fa-home gray"></i>
                <span class="menu-text"> Accueil</span>
            </a>

            <b class="arrow"></b>
        </li>

    </ul>
    
</div>
<!-- /.nav-list -->

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left"
       data-icon1="ace-icon fa fa-angle-double-left"
       data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
    try {
        ace.settings.check('sidebar', 'collapsed')
    } catch (e) {
    }
</script>
