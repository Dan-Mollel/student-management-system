<!DOCTYPE html>
<html>
   <head>
       <title>Students Page</title>

       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


        <style>
           .bg-custom {
            background:Linear-gradient(135deg, #4facfe, #00f2fe);
            
            }
            .card {
                border :none;
                border-radius: 15px;
                box-shadow: 0 6px 20px rgba(0,0,0,0.08);
                transition: 0.3s ease;
                background: rgba(255,255,255,0.9);
                backdrop-filter: blur(5px);
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 30px rgba(0,0,0,0.15);
            }
            .card h2 {
                font-size: 20px;
                font-weight:bold;
            }
            .table tbody tr:hover{
                background-color :#f0f8ff;
                transition:0.3;
            }
            .sidebar{
                width:180px;
                height:100vh;
                position:fixed;
                left:0;
                top: 55px;
                background:#1e293b;
                padding-top:20px;
            }
            .sidebar a{
                display: block;
                color:white;
                text-decoration:none;
                padding:15px 20px;
                margin:5px 10px;
                border-radius:8px;
                font-weight:bold;
            }
            .sidebar a:hover{
                background:#334155;
            }
            .main-content {
               margin-left:170px;
               padding:20px;
            }
            .navbar-brand{
             margin-left: 150px;
             font-weight: bold;
            }
            .text-primary{
                font-weight:bold;
                margin-left: 180px;
            }
        
               
    </style>
    </head>
   <body class="bg-custom">
     <!-- NAVBAR -->
        <nav class="navbar navbar-dark bg-primary mb-4">
          <div class="container">
             <a class="navbar-brand" href="#">STUDENT SYSTEM</a>

              <div>
                    <a href="#" class="btn btn-light btn-sm">Home</a>
                    <a href="#" class="btn btn-light btn-sm">Student</a>
                    <a href="#" class="btn btn-light btn-sm">Course</a>
                    <a href="#" class="btn btn-light btn-sm">Department</a>
                </div>
           </div>
        </nav>

        <!--SIDEBAR-->
        <div class="sidebar">
            <h3 class="text-white text-center mb-4">SMS</h3>
            <a href="#">Dashboard</a>
            <a href="#">Students</a>
            <a href="#">Courses</a>
            <a href="#">Departments</a>
            <a href="#">Settings</a>
        </div> 

        <!-- CONTENT -->
        <div class="main-content">

                <div class="card shadow p-3 mb-4">
                    <h4 class="text-primary">STUDENT LIST</h4>
                    <p class="text-muted">Manage all students in the system</p>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <h5>Total students</h5>
                                <h2>{{ $totalStudents }}</h2>
                          </div>
                      </div>
                    <div class="col-md-4">
                        <div class="card p-3 text-center">
                            <h5>Total Courses</h5>
                            <h2>2</h2>
                        </div>
                    </div>
                      <div class="col-md-4">
                            <div class="card p-3 text-center">
                              <h5>Total Departments</h5>
                              <h2>3</h2>
                           </div>
                     </div>
                  </div>
                </div>
            <form method="GET" action="/students" class="mb-3">
                    <input type="text"
                    name="search" 
                    class="form-control" 
                    placeholder="search by name..."
                    value="{{ request('search')}}">
                </form>

               <table class="table table-striped table-hover">
                    <thead class="table-dark">
                    
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                   </thead>

                   <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->course }}</td>
                            
                          <td>
                             <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        + Add Student
                           </button>
                                <button class="btn btn-warning btn-sm editBtn"
                                    data-id="{{ $student->id }}"
                                    data-name="{{ $student->name }}"
                                    data-email="{{ $student->email }}"
                                    data-course="{{ $student->course }}" 
                                    data-department="{{ $student->department }}" data-bs-toggle="modal" data-bs-target="#editStudentModal">Edit
                                </button>
                        
                               <form action="{{ url('/students/' . $student->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')

                                    <button type="submit"
                                      class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this student?')">Delete
                                   </button>
                               </form>

                            </td>
                       </tr>
                        @endforeach
                  </tbody>
               </table>

            </div>

        </div>  
             <!-- ADD STUDENT MODAL -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1">
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                <h5 class="modal-title">Add Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">

                                  <form action="{{ url('/students/store') }}" method="POST">
                                     @csrf

                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>

                                       <div class="mb-3">
                                          <label>Email</label>
                                          <input type="email" name="email" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Course</label>
                                            <input type="text" name="course" class="form-control" required>
                                        </div>  

                                        <button class="btn btn-primary w-100">Save Student</button>
                                  </form>
                              </div>

                            </div>
                       </div>
     </div>
        <div class="modal fade" id="editStudentModal"tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                         <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" class="form-control mb-3" name="name" id="editName" placeholder="Student Name">
                            <input type="text" class="form-control mb-3" name="email" id="editEmail" placeholder="Email">
                            <input type="text" class="form-control mb-3" name="course" id="editCourse" placeholder="Course">
                            <input type="text" class="form-control mb-3" name="department" id="editDepartment" placeholder="Department">
                            <div class="modal-footer">
                                <button class="btn btn-primary">Update Student</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
       </div>   
 
        <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> 
        </script>
        <script>
            document.querySelectorAll('.editBtn').forEach(button=> {
            button.addEventListener('click', function (){

            document.getElementById('editName').value = this.dataset.name;
            document.getElementById('editEmail').value = this.dataset.email;
            document.getElementById('editCourse').value = this.dataset.course;
            document.getElementById('editDepartment').value = this.dataset.department;
            document.getElementById('editForm').action="/students/" + this.dataset.id;
             })
             })
        </script>
    </body>
</html>