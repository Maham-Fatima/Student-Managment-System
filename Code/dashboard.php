<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  echo "Error Unauthorize access";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <style>
    .approval-dropdown {
      display: inline-block;
      vertical-align: middle;
      position: relative;
      cursor: pointer;
      user-select: none;
    }

    .display-enrolled-student-button,
    .add-student-attendance-button,
    .student-attendance-view-button,
    .add-attendance-button,
    .submit-button-mark,
    .submit-button-mark-std,
    .add-marks-button,
    .add-student-marks-button,
    .student-marks-view-button,
    .submit-button-marking-std,
    .view-marks-button-student,
    .view-marks-button,
    .enroll-button-course,
    .view-attendance-button-student,
    .view-attendance-button{
      background-color: blue;
      color: white;
      border-radius: 10px;
      padding: 3px;
      margin: 3px;
      width:6vw;
    }
    .edit-button-course{
      background-color: green;
      color: white;
      border-radius: 10px;
      padding: 3px;
      margin: 3px;
      width:6vw;
    }
    .delete-button-course{
      background-color: red;
      color: white;
      border-radius: 10px;
      padding: 3px;
      margin: 3px;
      width:6vw;
    }
    
    
    .marks-field {
    display: inline-block;
    vertical-align: middle;
    position: relative;
    border: 1px solid #ccc; 
    border-radius: 4px; 
    font-size: 16px; 
    line-height: 1.5; 
    outline: none; 
}

.marks-field:focus {
    border-color: #007bff; 
    box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25); 
}

    .enable-dropdown,.attendance-dropdown {
      display: inline-block;
      vertical-align: middle;
      position: relative;
      cursor: pointer;
      user-select: none;
    }

    .submit-button-approval {
      background-color: blue;
      color: white;
      border-radius: 10px;
      padding: 3px;
    }

    .submit-button-enable {
      background-color: blue;
      color: white;
      border-radius: 10px;
      padding: 3px;
    }

    .submit-button-approval :hover {
      background-color: skyblue;
    }

    .submit-button-enable :hover {
      background-color: skyblue;
    }
  </style>
</head>

<body>
  <nav class="bg-gradient-to-b from-blue-900 to-blue-600 p-5 md:items-center h-[7vh] text-center text-white flex font-extrabold gap-x-2 justify-center items-center md:text-2xl overflow-y-hidden">
    <h6>
      <img src="https://upload.wikimedia.org/wikipedia/en/e/e4/National_University_of_Computer_and_Emerging_Sciences_logo.png" alt="logo" class="rounded-3xl h-[5vh] hover:h-[7vh]" />
    </h6>
    <h5>Dashboard</h5>
  </nav>
  <nav class="bg-blue-900 p-5 md:items-center md:justify-end mr-2 w-full md:h-[50px] h-auto text-white font-bold flex flex-col md:flex-row">
    <div class="md:hidden flex justify-end">
      <button onclick="displayMenu()">
        <i class="bi bi-list border-white border-2 rounded px-2"></i>
      </button>
    </div>
    <ul class="md:flex md:flex-row flex-col hidden" id="menu-bar">
      <li class="mr-3 hover:bg-blue-500 p-2 rounded">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="mr-3 hover:bg-blue-500 p-2 rounded">
        <a href="">Contact</a>
      </li>
      <li class="mr-3 hover:bg-blue-500 p-2 rounded">
        <a href="">About us</a>
      </li>
    </ul>
    <div class="text-white hidden md:block p-2 " id="drop-down">
      <select name="option" id="bar-menu" class="bg-blue-900" >

        <option value="logout">Logout</option>
        <option value="changepassword">Change password</option>
        <option value="viewprofile">View profile</option>

      </select>
    </div>


  </nav>
  <h1>
    <button class="m-2" id="toggleButton" onclick="HideView()">
      <i class="bi bi-list fixed left-2 px-2 border-slate-900 border-2 rounded"></i>
    </button>
  </h1>
  <div class="flex w-full">
    <nav class="fixed md:top-[12vh] top-[65px] bottom-[8vh] left-0 hidden md:block w-[300px] items-center bg-blue-900 text-center text-white overflow-y-hidden" id="sidebar">
      <div class="flex flex-col">
        <h2 class="font-bold mx-2 p-3">
          <i class="bi bi-journal mr-1"></i>Menu<i class="bi bi-arrow-bar-left" onclick="cancel()"></i>
        </h2>
        <div id="sidebar-content">

        </div>

      </div>
    </nav>
    <main id="main" class="flex bg-gray-200 shadow rounded md:ml-[320px] ml-[60px] w-full h-[70vh] p-5 m-3 overflow-hidden">
      content
    </main>

    <footer class="h-footer md:h-[5vh] flex justify-center items-center bg-gradient-to-t from-blue-600 to-blue-900 w-full text-white fixed bottom-0">
      Copyright 2024
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
      let clicked = false;

      function HideView() {
        document.getElementById("sidebar").classList.remove("hidden");
        document.getElementById("main").classList.add("md:ml-[320px]");
        document.getElementById("main").classList.remove("ml-[60px]");
      }

      function cancel() {
        document.getElementById("sidebar").classList.add("hidden");
        document.getElementById("sidebar").classList.remove("md:block");
        document.getElementById("main").classList.remove("md:ml-[320px]");
        document.getElementById("main").classList.add("ml-[60px]");
      }

      function displayMenu() {
        if (clicked === false) {
          document.getElementById("drop-down").classList.remove("hidden");
          document.getElementById("menu-bar").classList.remove("hidden");
          clicked = true;
        } else {
          document.getElementById("drop-down").classList.add("hidden");
          document.getElementById("menu-bar").classList.add("hidden");
          clicked = false;
        }
      }
      $(document).ready(
        function() {

          $.ajax({
            url: "loadsidebar.php",
            type: "post",
            success: function(data) {
              $("#sidebar-content").html(data);
            }
          });
        }
      );
      $(document).on('click','#enrollcourses',function(e){
         e.preventDefault();
         $.ajax({
            url: "enrollcourse.php",
            type: "post",
            success: function(data) {
              $("#main").html(data);
            }
          });
      });
      $(document).on('click','.enroll-button-course',function(e){
         e.preventDefault();
         var cid = $(this).data('id');
         console.log(cid)
         $.ajax({
            url: "courseEnrollSave.php",
            type: "post",
            data:{id:cid},
            success: function(data) {
              $("#main").html(data);
            }
          });
      });

      $("#bar-menu").on('change', function() {
        var option = $(this).val();
        if (option === "logout") {
          $.ajax({
            url: "logout.php",
            type: "post",
            success: function(data) {
              if (data == 1) {
                window.location.href = "index.php";
              }
            }
          });
        } else if (option === "changepassword") {
          $.ajax({
            url: "changepassword.php",
            type: "post",
            success: function(data) {
              if (data) {
                $("#main").html(data);
              }
            }
          });
        } else if (option === "viewprofile") {
          $.ajax({
            url: "viewprofile.php",
            type: "post",
            success: function(data) {
              $("#main").html(data);
            }
          });
        }
      });
      $(document).on('click', '#save', function(e) {
        e.preventDefault();
        var password = $("#password").val();
        console.log(password);
        $.ajax({
          url: "updatepassword.php",
          type: "post",
          data: {
            pass: password
          },
          success: function(data) {
            if (data === "1") {
              window.location.href = "index.php";
            } else {
              $("#main").html(data);
            }
          }

        });
      });
      $(document).on('click', '#courseassign', function(e) {
        e.preventDefault();
        $.ajax({
          url: "courseAssign.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      $(document).on('click', '#assignCourseButton', function(e) {
        e.preventDefault();

        var fid = $('#faculty-list').val();
        var cid = $('#course-list').val();
        console.log(fid + cid);
        if (Number(fid) >= 0 && cid != null)
          $.ajax({
            url: "CourseAssignMain.php",
            type: "post",
            data: {
              facultyId: fid,
              courseId: cid
            },
            success: function(data) {
              $("#main").html(data);
            }
          });
      });
      $(document).on('click', '#ViewAssignedCourses', function(e) {
        e.preventDefault();
        $.ajax({
          url: "displayAssignedCourses.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

      $(document).on('click', '#assignedcourse', function() {
        $.ajax({
          url: "DisplayAssignedCoursesFaculty.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

      $(document).on('click', '#addcourse', function(e) {
        e.preventDefault();
        $.ajax({
          url: "addcourse.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      $(document).on('click', '#submitcourse', function(e) {
        e.preventDefault();
        console.log("called");
        $.ajax({
          url: "courseSubmit.php",
          type: "post",
          data: {
            courseId: $("#courseId").val(),
            courseName: $("#courseName").val()
          },
          success: function(data) {
            if (data === "fail") {
              $("#main").html(" < div class = 'max-w-md mx-auto bg-white rounded-lg shadow-lg p-6' ><h2 class = 'text-xl text-red-500 font-bold mb-4'>Fail to add the course.format error or id duplicate </h2></div >");
            } else {
              $("#main").html(data);
            }

          }
        });
      });

      $(document).on('click', '#approvestudent', function(e) {
        e.preventDefault();
        loadPending();
      });
      $(document).on('click', '.submit-button-approval', function(e) {
        e.preventDefault();
        var selectedValue = $(this).siblings('.approval-dropdown').val();
        var studentId = $(this).data('id');

        if (Number(studentId) >= 0) {

          $.ajax({
            url: "approveStudent.php",
            type: "post",
            data: {
              ID: studentId,
              Action: selectedValue
            },
            success: function(data) {

              if (data === "1") {
                loadPending();
              } else {
                $("#main").html("< div class = 'max-w-md mx-auto bg-white rounded-lg shadow-lg p-6' ><h2 class = 'text-xl text-red-500 font-bold mb-4'>Error: Fail to perform the task </h2></div >");
              }

            }
          });
        }

      });

      function loadPending() {
        $.ajax({
          url: "displayUnapproved.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      }

      function loadstudentstatus() {
        $.ajax({
          url: "displaydisablestudent.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      }
      
      $(document).on('click', '#enablestudent', function(e) {
        e.preventDefault();
        loadstudentstatus();
      });
      $(document).on('click', '.submit-button-enable', function(e) {
        e.preventDefault();
        var selectedValue = $(this).siblings('.enable-dropdown').val();
        var studentId = $(this).data('id');
        if (Number(studentId) >= 0) {

          $.ajax({
            url: "enablestudent.php",
            type: "post",
            data: {
              ID: studentId,
              Action: selectedValue
            },
            success: function(data) {
              if (data === "1") {
                loadstudentstatus();
              } else {
                $("#main").html("< div class = 'max-w-md mx-auto bg-white rounded-lg shadow-lg p-6' ><h2 class = 'text-xl text-red-500 font-bold mb-4'><h2>Error: Fail to perform the task </h2></div >");
              }

            }
          });
        }
      });
      $(document).on('click', '#viewcourse', function() {
        
        $.ajax({
          url: "displaycourse.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      $(document).on('click', '#viewfaculty', function() {
        $.ajax({
          url: "displayfaculty.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      $(document).on('click', '#viewadmin', function() {
        $.ajax({
          url: "displayadmin.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });


      //deletion and editing
      $(document).on('click', '#edit-button-profile', function(e) {
        e.preventDefault();
        $.ajax({
          url: "editProfile.php",
          type: "post",
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      $(document).on('click', '#save-button-profile', function(e) {

        e.preventDefault();

        var name = $("#name").val();
        var password = $("#pass").val();
        var email = $("#email").val();
        var profileImage = $('#profileImage')[0].files[0];


        var formData = new FormData(); 
        formData.append('name', name);
        formData.append('password', password);
        formData.append('email', email);
        formData.append('profileImage', profileImage); 

        $.ajax({
            url: 'editProfileSave.php',
            type: 'post',
            data: formData,
            processData: false, // Don't process the data (important for handling files)
            contentType: false, // Don't set contentType (important for handling files)
            success: function(response) {
                if (response) {
                  $("#main").html(response);
                } 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        
        });
      });



      $(document).on('click', '.edit-button-course', function(e) {
        e.preventDefault();
        var cid = $(this).data('id');
       
        $.ajax({
          url: "editCourse.php",
          type: "post",
          data: {id:cid},
          success: function(data) {
            $("#main").html(data);
          }
        });
       
      });
      $(document).on('click', '#save-button-course', function(e) {
        
        e.preventDefault();

        var id = $("#id").val();
        var nam = $("#name").val();
        
        $.ajax({
          url: "editCourseSave.php",
          type: "post",
          data:{courseId:id,coursename:nam},
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

      $(document).on('click', '.delete-button-course', function(e) {
        e.preventDefault();
        var cid = $(this).data('id');
        if(confirm("Do you want to delete course")){
           $.ajax({
          url: "deleteCourse.php",
          type: "post",
          data: {id:cid},
          success: function(data) {
            $("#main").html(data);
          }
        });
        }
       
      });


      //faculty

    // view assigned courses
      $(document).on('click', '#assignedcourses', function() {
        
        displayCriteria("viewonly");
      });

      //view enroll students in each course
      $(document).on('click', '#enrolledstudents', function() {
        displayCriteria("display");
      });

      $(document).on('click', '.display-enrolled-student-button', function(e) {
        e.preventDefault();
        var ccid = $(this).data('id');
        $.ajax({
          url: "DisplayEnrolledStudents.php",
          type: "post",
          data: {
            cid: ccid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      });




      //add course attendance
      $(document).on('click', '#markcourseattendance', function(e) {
        e.preventDefault();
        displayCriteria("addattendance");
      });
      $(document).on('click', '.add-attendance-button', function(e) {
        e.preventDefault();
        var ccid = $(this).data('id');
        $.ajax({
          url: "addAttendance.php",
          type: "post",
          data: {
            cid: ccid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

      $(document).on('click', '#courseattendance', function(e) {
        e.preventDefault();
        var ccid = $(courseId).val();
        var ddate = $(date).val();
        $.ajax({
          url: "courseattendancemain.php",
          type: "post",
          data: {
            cid: ccid,
            date: ddate
          },
          success: function(data) {
            //later add redirect to mark student by using get 
            $("#main").html(data);
          }
        });
      });

      //Manage attendance
      $(document).on('click', '#manageattendance', function(e) {
        e.preventDefault();
        displayCriteria("markstudentattendance");
      });

      


      $(document).on('click', '.add-student-attendance-button', function(e) {
        e.preventDefault();
        var ccid = $(this).data('id');
        $.ajax({
          url: "displayattendencelist.php",
          type: "post",
          data: {
            cid: ccid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

    

      //display student
      $(document).on('click', '.student-attendance-view-button', function(e) {
        e.preventDefault();       
        var aaid = $(this).data('id');      
        displayStudentAttendance(aaid);
      });




      function displayStudentAttendance(aaid) {
        console.log(aaid);
        $.ajax({
          url: "DisplayStudentsForAttendance.php",
          type: "post",
          data: {
            attendance: aaid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      }



      //assign class and data-id according to requirements
      function displayCriteria(display) {
        $.ajax({
          url: "DisplayAssignedCoursesFaculty.php",
          type: "post",
          data: {
            type: display
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      }

      




      //marks assign
      //course
     
      $(document).on('click', '#addcoursemarks', function(e) {
        e.preventDefault();
        displayCriteria("addmarks");
      });

      $(document).on('click', '.add-marks-button', function(e) {
        e.preventDefault();
        var ccid = $(this).data('id');
        $.ajax({
          url: "addMarks.php",
          type: "post",
          data: {
            cid: ccid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      });


      $(document).on('click', '#coursemarks', function(e) {
        e.preventDefault();
        var ccid = $("#courseId").val();
        var ttype = $("#type").val();
        var ttotal_Marks = $("#totalMarks").val();
        $.ajax({
          url: "addMarksMain.php",
          type: "post",
          data: {
            cid: ccid,
            type: ttype,
            total_marks:ttotal_Marks
          },
          success: function(data) {
            //later add redirect to mark student by using get 
            $("#main").html(data);
          }
        });
      });

       //student mark managment
      $(document).on('click', '#uploadmarks', function() {
        displayCriteria("marksstudentmarks");
      });

      $(document).on('click', '.add-student-marks-button', function(e) {
        e.preventDefault();
        var ccid = $(this).data('id');
        $.ajax({
          url: "displaymarkslist.php",
          type: "post",
          data: {
            cid: ccid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      });     
      

      //display student Marks for updating
      $(document).on('click', '.student-marks-view-button', function(e) {
        e.preventDefault();       
        var mmid = $(this).data('id');      
        displayStudentMarks(mmid);
      });
      
      function displayStudentMarks(mmid) {
        
        $.ajax({
          url: "DisplayStudentsForMarks.php",
          type: "post",
          data: {
            mid: mmid
          },
          success: function(data) {
            $("#main").html(data);
          }
        });
      }

      
      $(document).on('click', '.submit-button-marking-std', function(e) {
        e.preventDefault();
        var selectedValue = $(this).siblings('.marks-field').val();
        var smid = $(this).data('id');
        var mid = $(this).data('mid');
       
        if (Number(smid) >= 0) {

          $.ajax({
            url: "MarkingMain.php",
            type: "post",
            data: {
              ID: smid,
              Marks: selectedValue
            },
            success: function(data) {
              if (data === "1") {
                displayStudentMarks(mid)
              } else {
                $("#main").html(data);
              }

            }
          });
        }      
        
      });

      //view marks
      $(document).on('click','.view-marks-button',function(e){
        e.preventDefault();
        var ccid = $(this).data('id');  
        $.ajax({
          url: "viewmarksfa.php",
          type: "post",
          data:{cid:ccid},
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
      //view attendance
      $(document).on('click','.view-attendance-button',function(e){
        e.preventDefault();
        var ccid = $(this).data('id');  
        console.log(ccid);
        $.ajax({
          url: "viewattendancefa.php",
          type: "post",
          data:{cid:ccid},
          success: function(data) {
            $("#main").html(data);
          }
        });
      });

      //student features



      $(document).on('click', '#viewmarks', function(e) {
        e.preventDefault();
        displayCriteria("viewmarks");
      });

      $(document).on('click','.view-marks-button-student',function(e){
        e.preventDefault();
        var ccid = $(this).data('id');  
        $.ajax({
          url: "displaystudentmarks.php",
          type: "post",
          data:{cid:ccid},
          success: function(data) {
            $("#main").html(data);
          }
        });
      });
 



      $(document).on('click', '#viewattendance', function(e) {
        e.preventDefault();
        displayCriteria("viewattendance");
      });

      $(document).on('click','.view-attendance-button-student',function(e){
        e.preventDefault();
        var ccid = $(this).data('id');  
        console.log(ccid);
        $.ajax({
          url: "viewattendanceforstd.php",
          type: "post",
          data:{cid:ccid},
          success: function(data) {
            $("#main").html(data);
          }
        });
      })



    </script>


</body>

</html>