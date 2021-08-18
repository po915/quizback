@extends('layout.main')

@section('content')
  <div class="is-active" val="quiz"></div>
  <div class="main-content container-fluid">
    <div class="page-title">
      <h3>Quiz Management</h3>
    </div>

    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal">
      Add New Quiz
    </button>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <table class='table table-striped'>
            <thead>
              <tr>
                <th style="width: 15%">Quiz Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Test Title</td>
                <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus rem minus dignissimos fuga perspiciatis, necessitatibus fugiat? Molestias nisi perspiciatis culpa sapiente,
                  reprehenderit error dignissimos quam. Ut eligendi accusamus aut eos?</td>
                <td>60 min</td>
                <td>edit/delete</td>
              </tr>
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
              <label class="form-label">Quiz Title</label>
              <input type="text" placeholder="Title of Quiz" id="title" name="title" class="form-control" required />
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label class="form-label">Quiz Date</label>
                  <input type="date" name="date" class="form-control" required />
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label class="form-label">Quiz Duration</label>
                  <input type="number" name="duration" class="form-control" required min="1" max="200" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Quiz Description</label>
              <textarea type="date" name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="category" id="category" class="form-select" required>
                <option value="all" checked>All</option>
                @foreach ($categories as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="checkbox">
              <input type="checkbox" class="form-check-input" id="checkAll">
              <label for="checkAll" class="form-label">Check All Items in the box</label>
            </div>
            <div class="box-1">
              @foreach ($categories as $category)
                <div class="question-group" data-category="{{ $category->id }}">
                  @foreach ($questions as $question)
                    @if ($question->category == $category->id)
                      <div class="form-check">
                        <div class="checkbox">
                          <input type="checkbox" class="form-check-input" id="{{ $question->id }}" value="{{ $question->id }}">
                          <label for="{{ $question->id }}" class="form-label">{{ $question->content }}</label>
                        </div>
                      </div>
                    @endif
                  @endforeach
                </div>
              @endforeach
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
    $("#category").change(function() {
      var category = $(this).val()
      if (category == "all") {
        $(".question-group").each(function() {
          $(this).removeClass("hidden")
        })
      } else {
        $(".question-group").each(function() {
          $(this).addClass("hidden")
          if ($(this).data('category') == category) {
            $(this).removeClass("hidden")
          }
        })
      }
    })

    $("#checkAll").change(function() {
      if ($(this).is(':checked')) {
        $(".question-group").each(function() {
          if (!$(this).hasClass("hidden")) {
            $(this).find("[type='checkbox']").prop('checked', true)
          }
        })
      } else {
        $(".question-group").each(function() {
          if (!$(this).hasClass("hidden")) {
            $(this).find("[type='checkbox']").prop('checked', false)
          }
        })
      }
    })

    $("#cat_select").change(function() {
      $("[name='categories']").val(JSON.stringify($(this).val()))
    })

    $("#add-quiz").submit(function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{ route('add-quiz') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          console.log("wejoiwjefoij", JSON.parse(res.categories))
          // console.log(res)
          // window.location.href = "/quiz";
        },
        error: function(err) {
          console.log("Error", err);
        },
      });
    });
  </script>
@endsection
