@extends('layout.main')

@section('content')
  <div class="is-active" val="category"></div>
  <div class="main-content container-fluid">
    <div class="page-title">
      <h3>Category</h3>
    </div>
    <section class="section">
      <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#addModal">
        Add New Categry
      </button>

      <div class="card">
        <div class="card-body">
          <table class='table table-striped' id="table1">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Questions</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $item)
                <tr>
                  <td>
                    <img src="storage/image/{{ $item->icon }}" alt="icon" class="icon-in-table" />
                  </td>
                  <td>{{ $item->name }}</td>
                  <td>125</td>
                  <td>
                    <a href="#" class="btn icon btn-primary" onclick="editCategory({{ $item }})"><i data-feather="edit"></i></a>
                    <a href="#" class="btn icon btn-danger" onclick="deleteCategory({{ $item->id }})"><i data-feather="trash"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form id="category_add">
          <div class="modal-body">
            <input type="hidden" name="id" id="catId">
            <label>Category Name: </label>
            <div class="form-group">
              <input type="text" placeholder="Category Name" id="catName" name="name" class="form-control" required />
            </div>
            <div class="contain animated bounce">
              <div class="alert"></div>
              <div id='img_contain'>
                <img id="blah" align='middle' src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png" alt="your image" title='' />
              </div>
              <label for="">Category Icon: </label>
              <div class="form-file">
                <input type="file" class="form-file-input" id="catIcon" name="icon" aria-describedby="inputGroupFileAddon01" accept="image/*" required />
                <label class="form-file-label" for="customFile">
                  <span class="form-file-text">Choose file...</span>
                  <span class="form-file-button">Browse</span>
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary ml-1">
                Save
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const container = document.getElementById("addModal");
    const modal = new bootstrap.Modal(container);

    $("#catIcon").change(function(event) {
      RecurFadeIn();
      readURL(this);
    });
    $("#catIcon").on('click', function(event) {
      RecurFadeIn();
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var filename = $("#catIcon").val();
        filename = filename.substring(filename.lastIndexOf('\\') + 1);
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
          $('#blah').hide();
          $('#blah').fadeIn(500);
          $('.custom-file-label').text(filename);
        }
        reader.readAsDataURL(input.files[0]);
      }
      $(".alert").removeClass("loading").hide();
    }

    function RecurFadeIn() {
      FadeInAlert("Wait for it...");
    }

    function FadeInAlert(text) {
      $(".alert").show();
      $(".alert").text(text).addClass("loading");
    }

    $("#category_add").submit(function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{ route('add-category') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          console.log(res)
          window.location.href = "/dashboard";
        },
        error: function(err) {
          console.log("Error", err);
        },
      });
    });

    document.getElementById("btnSave").addEventListener("click", function() {
      const container = document.getElementById("testModal");
      const modal = new bootstrap.Modal(container);
      modal.hide();
    });

    function editCategory(category) {
      $("#catId").val(category.id);
      $("#catName").val(category.name);
      $("#catIcon").attr("required", false);
      $("#blah").attr("src", "/storage/image/" + category.icon);
      modal.show();
    }

    function deleteCategory(id) {
      if (confirm("Are you sure want to delete this category?")) {
        $.ajax({
          type: "POST",
          url: "{{ route('delete-category') }}",
          data: {
            id: id
          },
          success: (res) => {
            window.location.href = "/dashboard"
          },
          error: function(err) {
            console.log("Error", err);
          },
        });
      }
    }
  </script>
@endsection
