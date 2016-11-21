<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <!--<li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>-->
                    <li><a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manajemen User<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo base_url('Users')?>">Users</a></li>
                            <li><a href="<?php echo base_url('Groups')?>">Groups</a></li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="<?php echo base_url('ImportExcel') ?>"><i class="fa fa-table fa-fw"></i> Import Data Pemilih</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Section') ?>"><i class="fa fa-edit fa-fw"></i> Section</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Voter <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('Voter') ?>">Voter </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('VoterList') ?>">Voter List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('VoterWaiting') ?>">Voter Waiting</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
