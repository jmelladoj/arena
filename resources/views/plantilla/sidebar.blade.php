<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- MENÚ</li>
                <li @click="menu=0"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">DASHBOARD</span></a></li>
                <li @click="menu=1"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">INVITADOS</span></a></li>
                <li @click="menu=2"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">INDIVIDUAL</span></a></li>
                <li @click="menu=3"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">DUPLAS</span></a></li>
                <li @click="menu=4"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">TRÍOS</span></a></li>
                <li @click="menu=5"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-ban"></i><span class="hide-menu">PENDIENTES</span></a></li>
                <li @click="menu=6"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">TODOS</span></a></li>
                <li @click="menu=7"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-bars"></i><span class="hide-menu">CATEGORÍAS</span></a></li>
                <li @click="menu=8"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-product-hunt"></i><span class="hide-menu">POLERAS</span></a></li>
                <li @click="menu=9"> <a class="waves-effect waves-dark" href="javascript::void(0)" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">VENTAS</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" aria-expanded="false" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="hide-menu">CERRAR SESIÓN</span> </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form></li>
            </ul>
        </nav>
    </div>
</aside>
