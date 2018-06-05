@section('nav')
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/">News</a>
        <a href="/sources">Sources</a>
        <a href="/people">People</a>
        <a href="/profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>

    <span class="nav-btn" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
@show