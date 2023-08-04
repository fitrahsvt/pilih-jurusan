<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{route('food.index')}}">
                <div class="sb-nav-link-icon"><i class='bx bxs-food-menu'></i></div>
                Food
            </a>

            <a class="nav-link" href="{{route('user.index')}}">
                <div class="sb-nav-link-icon"><i class='bx bxs-user' ></i></div>
                User
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{Auth::user()->name}} ({{Auth::user()->role->name}})
    </div>
</nav>
