<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="wrapper" class="d-flex">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">OWNER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <i class="bi bi-gear"></i>
                    <span>Rooms</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Owner:</h6>
                        <a class="collapse-item" href="{{ route('admin.owners') }}">Post</a>
                        <a class="collapse-item" href="{{ route('admin.renters') }}">Incoming Request</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column" style="margin-top: 50px;"> <!-- Adjust margin here -->
            <!-- Main Content -->
            <div id="content" class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Owners Dashboard</h1>
                    </a>
                </div>

                <!-- Content Row -->
                <div class="row">
                <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

              <div class="div_center">
                <h1>Add Rooms</h1>
                <form action="{{url('add_room')}}" method="Post" enctype="multipart/form-data">


                    @csrf

                    <div class="div_deg">
                        <label> Room title </label>
                        <input type="text" name="title">
                    </div>

                    <div class="div_deg">
                        <label> Room description </label>
                        <textarea name="description"></textarea>
                    </div>

                    <div class="div_deg">
                        <label> Price </label>
                        <input type="number" name="price">
                    </div>

                    <div class="div_deg">
                        <label> Room Type </label>
                        <select name="type">
                            <option  value = "studio">Studio</option>
                            <option value="apartment">Apartment</option>
                        </select>
                    </div>

                    <div class="div_deg">
                        <label> Wifi</label>
                        <select name="wifi">
                            <option  value = "yes">yes</option>
                            <option value="no">no</option>
                        </select>
                    </div> 

                    <div class="div_deg">
                        <label>Upload Image </label>
                        <input type= "file" name="image">
                    </div>

                    <div class="div_deg">
                        <input class="btn btn-primary" type="submit" value="Add Room">
                    </div>

                  


          </div>
        </div>
    </div>
    
    
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; StayWise 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
    </div>
</x-app-layout>
