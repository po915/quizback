@extends('layout.main')

@section('content')
  <div class="is-active" val="content"></div>
  <div class="main-content container-fluid">
    <div class="page-title">
      <h3>Content Management</h3>
    </div>
    <section class="section">
      <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal">
        Add New Content
      </button>
      <div class="card">
        <div class="card-body">
          <table class='table table-striped' id="table1">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Preview/Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($contents as $content)
                <tr>
                  <td>{{ $content->title }}</td>
                  @foreach ($categories as $category)
                    @if ($category->id == $content->category)
                      <td>{{ $category->name }}</td>
                    @endif
                  @endforeach
                  <td>
                    <a href="#" class="btn icon btn-primary"><i data-feather="play"></i></a>
                    <a href="#" class="btn icon btn-danger"><i data-feather="trash"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>

  </div>

  <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form id="add-content">
          <div class="modal-body">
            <input type="hidden" name="content_id" id="content_id">
            <div class="form-group">
              <label>Title</label>
              <input type="text" placeholder="Title of content" id="title" name="title" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="category" id="category" class="form-select" required>
                @foreach ($categories as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="d-flex mb-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="method" id="import_content" value="import" checked>
                <label class="form-check-label">
                  Import Content
                </label>
              </div>
              <div class="form-check ml-4">
                <input class="form-check-input" type="radio" name="method" id="upload_content" value="upload">
                <label class="form-check-label">
                  Upload Content
                </label>
              </div>
            </div>
            <div class="import">
              <div class="form-group">
                <label class="form-label">Import Url</label>
                <input type="text" placeholder="Import Link" id="import_url" name="import_url" class="form-control" />
              </div>
            </div>
            <div class="upload hidden">
              <div class="form-group">
                <label class="form-label">File Upload</label>
                <input class="form-control" type="file" id="content_file" name="content_file">
              </div>
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
    const container = document.getElementById("modal");
    const modal = new bootstrap.Modal(container);
    $("[name='method']").change(function() {
      if ($(this).val() == "import") {
        $(".import").show()
        $(".upload").hide()
      } else {
        $(".import").hide()
        $(".upload").show()
      }
    })

    $("#add-content").submit(function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{ route('add-content') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          console.log(res)
          window.location.href = "/content";
        },
        error: function(err) {
          console.log("Error", err);
        },
      });
    });
  </script>
@endsection
