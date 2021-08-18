@extends('layout.main')

@section('content')
  <div class="is-active" val="question"></div>
  <div class="main-content container-fluid">
    <div class="page-title">
      <h3>Questions</h3>
    </div>
    <section class="section">
      <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal">
        Add New Question
      </button>
      <div class="card">
        <div class="card-body">
          <table class='table table-striped' id="table1">
            <thead>
              <tr>
                <th>Question</th>
                <th>Category</th>
                <th>Type</th>
                <th>Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $query)
                <tr>
                  <td>{{ $query->content }}</td>
                  @foreach ($categories as $category)
                    @if ($category->id == $query->category)
                      <td>{{ $category->name }}</td>
                    @endif
                  @endforeach
                  @if ($query->type == 'option')
                    <td>Options</td>
                  @else
                    <td>True / False</td>
                  @endif
                  <td>
                    <a href="#" class="btn icon btn-primary" onclick="editQuestion({{ $query }})"><i data-feather="edit"></i></a>
                    <a href="#" class="btn icon btn-danger" onclick="deleteQuestion({{ $query->id }})"><i data-feather="trash"></i></a>
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
        <form id="question-manage">
          <div class="modal-body">
            <input type="hidden" name="question_id" id="questionId">
            <div class="form-group">
              <label>Question</label>
              <textarea placeholder="Question content" id="question" name="question" class="form-control" required></textarea>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Question Category</label>
                  <select name="category" id="category" class="form-select" required>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Question Type</label>
                  <select name="type" id="type" class="form-select">
                    <option value="option">Options</option>
                    <option value="tf">True/False</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="answer-option">
              <div class="form-group">
                <label for="">Answer A: </label>
                <input type="text" name="answer_a" id="answer_a" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Answer B: </label>
                <input type="text" name="answer_b" id="answer_b" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Answer C: </label>
                <input type="text" name="answer_c" id="answer_c" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Answer D: </label>
                <input type="text" name="answer_d" id="answer_d" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Correct Answer</label>
                <select name="correct_answer_option" id="correct_answer_option" class="form-control">
                  <option value="a">Answer A</option>
                  <option value="b">Answer B</option>
                  <option value="c">Answer C</option>
                  <option value="d">Answer D</option>
                </select>
              </div>
            </div>

            <div class="answer-true-false hidden">
              <div class="form-group">
                <label for="">Correct Answer</label>
                <select name="correct_answer_tf" id="correct_answer_tf" class="form-control">
                  <option value="true">True</option>
                  <option value="false">False</option>
                </select>
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

    $("#type").change(function() {
      if ($(this).val() == "option") {
        $(".answer-option").show()
        $(".answer-true-false").hide()
      } else {
        $(".answer-option").hide()
        $(".answer-true-false").show()
      }
    })

    $("#question-manage").submit(function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{ route('question-manage') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          console.log(res)
          window.location.href = "/question";
        },
        error: function(err) {
          console.log("Error", err);
        },
      });
    });

    function editQuestion(question) {
      $("#questionId").val(question.id)
      $("#question").val(question.content)
      $("#category").val(question.category)
      $("#type").val(question.type)
      if (question.type == "option") {
        $(".answer-true-false").hide()
        $(".answer-option").show()
        $("#answer_a").val(question.answer_a)
        $("#answer_b").val(question.answer_b)
        $("#answer_c").val(question.answer_c)
        $("#correct_answer_option").val(question.correct)
      } else {
        $(".answer-true-false").show()
        $(".answer-option").hide()
        $("#correct_answer_tf").val(question.correct)
      }
      modal.show()
    }

    function deleteQuestion(id) {
      if (confirm("Are you sure want to delete this question?")) {
        $.ajax({
          type: "POST",
          url: "{{ route('delete-question') }}",
          data: {
            id: id
          },
          success: (res) => {
            window.location.href = "/question"
          },
          error: function(err) {
            console.log("Error", err);
          },
        });
      }
    }
  </script>
@endsection
