document.addEventListener("DOMContentLoaded", function (event) {

  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId)
    changecat = document.getElementById("change_cat")
    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener('click', () => {
        // show navbar
        nav.classList.toggle('show-menu')
        // // change icon
        // toggle.classList.toggle('nav_icon')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        changecat.classList.toggle("normal_width")
        changecat.classList.toggle("change_width")
      })
    }
  }

  showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')

  function colorLink() {
    if (linkColor) {
      linkColor.forEach(l => l.classList.remove('active'))
      this.classList.add('active')
    }
  }
  linkColor.forEach(l => l.addEventListener('click', colorLink))

  // Your code to run since DOM is loaded and ready
});



//Assign  minimum for end date when start date has been picked

function assign_min(start, end) {

  $("#end_date").attr("min", $("#" + start.id).val())
}

function show_float_option() {
  $(".float-plus i").addClass("clicked")
  if ($(".float-plus i").hasClass("fa-plus")) {
    $(".float-plus i").removeClass("fa-plus")
    $(".float-plus i").addClass("fa-close")
  } else {
    $(".float-plus i").removeClass("fa-close")
    $(".float-plus i").addClass("fa-plus")
  }
  if ($(".float-links").is(":hidden")) {
    $(".float-links").show("slow");
  } else {
    $(".float-links").hide("slow");
  }

  return false;
}

//Show status labels 
function show_status_labels(element) {
  $(element).next().show()
}
function hide_status_labels(element) {


  $(element).parent().parent().parent().hide()

}
function add_to_assigned_list(el) {

}

//Show assigned tasks for each employee

$(document).ready(function () {


  $('#employeeModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text(message + " " + recipient)
    // modal.find('.modal-body input').val(id)
  })

  $('#addTaskModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $("input[name='associated_with[]']").each(function (index, obj) {
      if ($(this).val() == id) {
        $(this).prop("checked", true);
      }
    });
    modal.find('.modal-title').text(message + " " + recipient)
    // modal.find('.modal-body input').val(id)
  })

  $('#viewHistoryModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    var url = button.data("url")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $(".assigned-task-list").html("Loading data...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }


    })
    $.ajax({
      url: url,
      method: 'GET',
      data: { id: id },
      success: function (response) {
        $(".assigned-task-list").html(response)
      }
    })
    modal.find('.modal-title').text(message + " " + recipient)
    // modal.find('.modal-body input').val(id)
  })

  $('#priviledgesModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    var url = button.data("url")

    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $(".priviledges-table").html("Loading data...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }


    })
    $.ajax({
      url: url,
      method: 'GET',
      data: { id: id },
      success: function (response) {
        $(".priviledges-table").html(response)
      }
    })
    modal.find('.modal-title').text(message + " " + recipient)
    // modal.find('.modal-body input').val(id)
  })


  $('#viewTaskModal').on('show.bs.modal', function (event) {


    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    var url = button.data("url")
    var todo = button.data("todo")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $(".task_details").html("Loading data...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }


    })
    $.ajax({
      url: url,
      method: 'GET',
      data: { id: id, todo: todo },
      success: function (response) {

        $(".task_details").html(response)
      }
    })
    modal.find('.modal-title').html(message)
    // modal.find('.modal-body input').val(id)
  })



  $('#viewAttachmentsModal').on('show.bs.modal', function (event) {


    var button = $(event.relatedTarget) // Button that triggered the modal


    var message = button.data("message")
    var url = button.data("url")
    var logo = button.data("logo")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $(".attachments_div").html("Loading data...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }


    })
    $.ajax({
      url: url,
      method: 'GET',
      data: { status: 'view', logo: logo },
      success: function (response) {

        $(".attachments_div").html(response)
      }
    })
    modal.find('.modal-title').html(message)
    // modal.find('.modal-body input').val(id)
  })

  $('#viewAsscTaskModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipient = button.data('name') // Extract info from data-* attributes
    var id = button.data('id')
    var message = button.data("message")
    var url = button.data("url")

    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $(".assoc_task").html("Loading data...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }


    })
    $.ajax({
      url: url,
      method: 'GET',
      data: { id: id },
      success: function (response) {
        $(".assoc_task").html(response)
      }
    })
    modal.find('.modal-title').html(message)
    // modal.find('.modal-body input').val(id)
  })

  $('.daterange').daterangepicker({
    showDropdowns: true,

  });

  //Edit  label Modal
  $('#edit-label').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var id = button.data('id')
    var message = button.data("message")
    var color = button.data("color")
    var column = button.data("column")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $("#edit-label-id").val(id)
    $("#edit-label-name").val(message)
    $("#edit-label-color").val(color.trim())
    $("#edit-label-column").val(column);

    modal.find('.modal-title').text("Edit " + message)
    // modal.find('.modal-body input').val(id)
  })

  //Add  label Modal
  $('#add-label').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal


    var message = button.data("message")
    var color = button.data("color")
    var column = button.data("column")
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)


    $("#add-label-column-2").val(column);

    modal.find('.modal-title').text(message)
    // modal.find('.modal-body input').val(id)
  })

  // Edit priority Modal 
  //Edit  label Modal
  $('#edit-priority-label').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var id = button.data('id')
    var message = button.data("message")
    var color = button.data("color")

    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $("#edit-priority-label-id").val(id)
    $("#edit-priority-label-name").val(message)
    $("#edit-priority-label-color").val(color.trim())


    modal.find('.modal-title').text("Edit " + message)
    // modal.find('.modal-body input').val(id)
  })
  $('#edit-status-label').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var id = button.data('id')
    var message = button.data("message")
    var color = button.data("color")

    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    $("#edit-status-label-id").val(id)
    $("#edit-status-label-name").val(message)
    $("#edit-status-label-color").val(color.trim())


    modal.find('.modal-title').text("Edit " + message)
    // modal.find('.modal-body input').val(id)
  })
})




$(document).ready(function () {
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    autoplay: true,
    dots: false,
    autoplayHoverPause: true
  });
});

//Bootstrap form validation


// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

$(".delete_project input[type=checkbox]").change(function () {
  confirm("Do you want to delete" + $(this).val());

})

function show_status_label_child(element) {
  $(element).children(".status-btns").show()
}

function add_assign_name(element, name) {
  $("#assigned_to_name").val(name);
}
var subtasks = [];
function add_subtask_list() {
  let subtask = $("#add_subtask").val();

  if (subtask !== "") {
    subtasks.push(subtask);
    $("#form-subtasks").val(subtasks.join("|"))
    $("#add_subtask").val('');

    $("#subtask_container").html("");
    $.each(subtasks, function (i, s) {
      $("#subtask_container").append("<li>" + s + "<span class='cursor-pointer pl-4' onclick='remove_subtask(" + i + ")'><i class='fas fa-times'></i></span></li>")
    })
    $("#new_subtask").collapse('hide')

  }
}
function add_comment() {
  let comment = $("#add_comment_text").val();
  $("#form-comment").val(comment);
  $(".p-comment").text(comment)
  $("#comment_container").show()
  $("#new_comment").collapse('hide')
}

function remove_subtask(indexV) {
  subtasks.splice(indexV, 1);
  $("#form-subtasks").val(subtasks.join("|"))
  $("#subtask_container").html("");
  $.each(subtasks, function (i, s) {
    $("#subtask_container").append("<li>" + s + "<span class='cursor-pointer pl-4' onclick='remove_subtask('" + i + ")'><i class='fas fa-times'></i></span></li>")
  })
}

function check_confirm(element) {
  let complete = true;
  let subtasks = $(element).data("incomplete");
  let view_btn = $(element).data("viewbtn")
  if ($(element).prop("checked")) {

    var r = confirm("Are you sure you want to mark as completed");
    complete = true

  } else {
    var r = confirm("Are you sure you want to mark as incomplete");
    complete = false;

  }



  if (r) {

    if (subtasks !== 0) {
      alert("You need to complete subtasks first!");
      console.log(view_btn)
      $(view_btn).click()
      if ($(element).prop("checked")) {
        $(element).prop("checked", false)
      } else {
        $(element).prop("checked", true)

      }
      return false
    }

    if (complete) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(element).data("url"),
        method: 'POST',
        data: { id: $(element).val(), status: "Completed" },
        success: function (response) {
          let res = JSON.parse(response)

          if (res.status == 1) {
            alert("You task status has been updated")
          }
          location.reload();
        }
      })
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(element).data("url"),
        method: 'POST',
        data: { id: $(element).val(), status: "Incomplete" },
        success: function (response) {
          let res = JSON.parse(response)


          if (res.status == 1) {
            alert("You task status has been updated")
          }

          location.reload();
        }
      })
    }
  } else {
    $(element).prop("checked", false)
  }
}

function check_subtask_confirm(element) {
  let complete = true
  if ($(element).prop("checked")) {

    var r = confirm("Are you sure you want to mark as completed");
    complete = true

  } else {
    var r = confirm("Are you sure you want to mark as incomplete");
    complete = false;

  }



  if (r) {

    if (complete) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(element).data("url"),
        method: 'POST',
        data: { id: $(element).val(), status: "Completed" },
        success: function (response) {

          let res = JSON.parse(response)

          if (res.status == 1) {
            alert("You task status has been updated")
            location.reload();
          }

        }
      })
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: $(element).data("url"),
        method: 'POST',
        data: { id: $(element).val(), status: "Incomplete" },
        success: function (response) {
          let res = JSON.parse(response)


          if (res.status == 1) {
            alert("You task subtask status has been updated")
            location.reload();
          }

        }
      })
    }
  } else {
    $(element).prop("checked", false)
  }
}

function edit_team(id, url) {
  $(".designation-form-container").html("Updating edit form...");
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: url,
    method: 'POST',
    data: { id: id, status: 'edit' },
    success: function (response) {
      $(".designation-form-container").html(response);
      location.href = "#designation-form-container";
    }
  })
}

function delete_team(id, url) {
  if (confirm("Are you sure you want to delete this user?")) {


    $(".designation-form-container").html("Updating edit form...");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: url,
      method: 'POST',
      data: { user_auto_id: id, delete: 1 },
      success: function (response) {
        location.reload();
      }

    })
  }

}

function delete_customers_status(element) {
  var ids = []
  if ($(element).val() == "all") {
    var r = confirm("Are you sure you want to delete all?");
    $(".delete_project").prop("checked", true);

    $(".delete_project").each(function () {
      ids.push($(this).val())
    })



  } else {
    var r = confirm("Are you sure you want to mark this as deleted? ");

  }
  // $(element).prop('checked', r);

  if (r) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: $(element).data("url"),
      method: 'POST',
      data: { id: $(element).val(), status: "Yes", user_auto_id: $(element).data('user'), ids: ids },
      success: function (response) {

        if (response.status == 1) {
          alert("data Deleted Successfully")
          location.reload()
        }


      }
    })
  } else {
    $(element).prop('checked', false);
  }

}


function add_task_comment_ajax(element) {
  let comment = $("#add_comment_ajax").val();
  let task_id = $(element).data("task");
  let url = $(element).data("url");

  $("#new_comment_ajax").collapse('hide')
  $("#comment_container_ajax").html("Loading Comments...");
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: url,
    method: 'POST',
    data: { task_auto_id: task_id, comment: comment },
    success: function (response) {
      $("#comment_container_ajax").html(response);
    }
  })
}

$(document).ready(function () {
  $("#change_password_form").submit(function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: $(this).attr("action"),
      method: 'POST',
      data: $(this).serialize(),
      success: function (res) {



        if (res.status == 0) {
          $(".error_message").show()
          $(".error_message").html(res.error)
        } else if (res.status == 1) {
          $(".error_message").hide()
          $(".message").show()
          $(".message").html(res.message)
          $("#change-password").modal("hide")
        }
      }
    })

  })
})
function show_forgot_password() {
  $(".forms_update").html($(".forgot_password_form").html())
}
function hide_forgot_password() {
  $(".forms_update").html($(".change_password_container").html())
}

function reactivate_customers_status(element) {
  var r = confirm("Are you sure you want to  restore? ");


  if (r) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: $(element).data("url"),
      method: 'POST',
      data: { id: $(element).data('id'), status: "No", user_auto_id: $(element).data('user') },
      success: function (response) {


        if (response.status == 1) {
          alert("Restoration successful")
        }
        location.reload();
      }
    })
  }
}


function delete_customers(element) {
  var r = confirm("This customer/candidate/lead  will be deleted permanently. Do you want to proceed? ");


  if (r) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: $(element).data("url"),
      method: 'POST',
      data: { customer_auto_id: $(element).data('id'), user_auto_id: $(element).data('user') },
      success: function (response) {


        if (response.status == 1) {
          alert("Deletion successful")
        }
        location.reload();
      }
    })
  }
}

function upload_attachments() {

  $("#attachment-file").click()

}

function assign_label_value(element) {
  $($(element).data("target")).val($(element).data("val"))

  $(element).closest("form").submit();
}


function show_add_checkbox_form(element, id) {
  $(id).html($(".add_check_form").html())
  $(element).hide();
}

$(document).ready(function () {
  $("#show_hide_password a").on('click', function (event) {
    event.preventDefault();
    if ($('#show_hide_password input').attr("type") == "text") {
      $('#show_hide_password input').attr('type', 'password');
      $('#show_hide_password i').addClass("fa-eye-slash");
      $('#show_hide_password i').removeClass("fa-eye");
    } else if ($('#show_hide_password input').attr("type") == "password") {
      $('#show_hide_password input').attr('type', 'text');
      $('#show_hide_password i').removeClass("fa-eye-slash");
      $('#show_hide_password i').addClass("fa-eye");
    }
  });
});
function select_country(element) {
  let country_code = $("#country :selected").data("code")

  $("#country_code").val(country_code)

}



$('#collapseOne').on('show.bs.collapse', function () {

  $(".subtasks-comments").removeClass("fa-angle-down")
  $(".subtasks-comments").addClass("fa-angle-up")
})

$('#collapseOne').on('hide.bs.collapse', function () {

  $(".subtasks-comments").removeClass("fa-angle-up")
  $(".subtasks-comments").addClass("fa-angle-down")
})

function add_task_comment() {
  let comment = $("#add_comment_text").val();
  $("#form-comment").val(comment);
  $(".p-comment").text(comment)
  $("#comment_container").show()
  $("#new_comment").collapse('hide')
}
function search_associated(el) {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("associated");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "block";
    } else {
      a[i].style.display = "none";
    }
  }
}
function add_associated_with(el) {
  let value = $(el).data("value")
  let name = $(el).data("name")

  let post_input = $("#associated_with_input").val();
  post_input = post_input.replace("[", '').replace("]", '');
  if (post_input == "") {
    post_input = "'" + value + "'";

  } else {
    post_input += "," + "'" + value + "'";

  }

  $("#associated_with_input").val("[" + post_input + "]")
  $(el).css("display", "none");
  $("#myInput").val('')
  $(".associate_selected").append('<li class="alert alert-info p-1 mx-1 my-1"  style="display: inline;">' + name + '<span class="pl-4 text-danger cursor-pointer" onclick="remove_associate(this,' + "'" + value + "'" + ')"> <i class="fas fa-times "></i></span> </li>')

}
function make_assign_array() {
  let post_input = $("#associated_with_input").val();

  let tempArr = post_input.replace(/\'/g, '');

  let inpuArr = tempArr.split(",");

  $("#associated_with_input").val(inpuArr)
  return false;
}
function remove_associate(el, id) {
  let post_input = $("#associated_with_input").val();

  let tempArr = post_input.replace("[", "").replace("]", "");
  let inpuArr = tempArr.split(",");
  const index = inpuArr.indexOf("'" + id + "'");
  if (index > -1) { // only splice array when item is found
    inpuArr.splice(index, 1); // 2nd parameter means remove one item only
  }

  post_input = "[" + inpuArr.toString() + "]";


  $(el).parent().hide();
  $("#associated-" + id).css("display", "bloack");
  $("#associated_with_input").val(post_input)
  // make_assign_array()
}


  var original_html =  $("#table_container").html();



function search_globally_dt(url, q) {
  if(q == "")
  {
    $("#table_container").html(original_html);
    return false;
  }
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }


  })

  $.ajax({
    url: url,
    method: "GET",
    data: { q: q },
    success: function (res) {

      $("#table_container").html(res);

      $("#data-table-3").DataTable({
        scrollX: true,
        paging: false,
        searching: false,
        "bInfo": false,
      })
      
    }

  })

}

function search_globally_paginated(url) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }


  })

  $.ajax({
    url: url,
    method: "GET",
    success: function (res) {
   
      $("#table_container").html(res);
 
     
      $("#data-table-3").DataTable({
        scrollX: true,
        paging: false,
        searching: false,
        "bInfo": false,
        "bAutoWidth": false
      })
    }

  })

}

function check_enter(el, e) {
  if (e.which == 13) {
    search_globally_dt($(el).data('url'), $(el).val())
  }
}
function select_all_customers()
{

  if ($(".delete_project:checked").length > 0)
  {
  $("#delete_all_customers_btn").removeClass("d-none");
  
}else
 
{
  if(!$("#delete_all_customers_btn").hasClass("d-none"))
  {
    $("#delete_all_customers_btn").addClass("d-none");

  }


}
}
function delete_customers_status(element) {
  var ids= []
  if ($(element).val() == "all")
  {
    var r = confirm("Are you sure you want to delete selected items");
    // $(".delete_project").prop("checked", true);
   
     $(".delete_project:checked").each(function(){
      ids.push($(this).val())
     })
    
   

  }else 
  {
    var r = confirm("Are you sure you want to mark this as deleted? ");

  }
  // $(element).prop('checked', r);

  if (r) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: $(element).data("url"),
      method: 'POST',
      data: { id: $(element).val(), status: "Yes", user_auto_id: $(element).data('user'), ids: ids },
      success: function (response) {
       
        if (response.status == 1) {
          alert("data Deleted Successfully")
          location.reload()
        }

       
      }
    })
  }else
  {
    $(element).prop('checked', false);
  }
  
}
