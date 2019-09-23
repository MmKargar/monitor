<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="<?= PUBLIC_PATH ?>storage/<?= $_SESSION['avatar'] ?>" alt="user" />
                <!-- this is blinking heartbit-->
                <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <h5><?= $_SESSION['fullname'] ?></h5>
                <!-- <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a> -->
                <!-- <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a> -->
                <form id="logout" action="<?= PUBLIC_PATH ?>login/logout" method="POST">
                    <a href="#" onclick="logout()" style="color:#455a64" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                    <input type="hidden" name="logout" value="1">
                </form>

                <div class="dropdown-menu animated flipInY">
                    <!-- text-->
                    <a href="<?= PUBLIC_PATH ?>person/profile" class="dropdown-item"><i class="ti-user"></i> MyProfile</a>
                    <!-- text-->
                    <!-- <a href="#" class="dropdown-item"><i class="ti-email"></i> MyMessages</a> -->
                    <!-- text-->
                    <!-- <div class="dropdown-divider"></div> -->
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="fa fa-power-off"></i> خروج</a>
                    <!-- text-->
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <!-- <li class="nav-small-cap">منوها</li> -->
                <li> <a class="waves-effect waves-dark" href="<?= PUBLIC_PATH ?>home/index" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?= PUBLIC_PATH ?>person/index" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->


