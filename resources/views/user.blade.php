@extends('layout.main')

@section('content')
  <div class="is-active" val="user"></div>
  <div class="main-content container-fluid">
    <div class="page-title">
      <h3>Normal User Management</h3>
    </div>
    <section class="section">
      <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#modal">
        Add New User
      </button>
      <div class="card">
        <div class="card-body">
          <table class='table table-striped' id="table1">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John Doe</td>
                <td>w@w.com</td>
                <td>
                  <a href="#" class="btn icon btn-primary"><i data-feather="edit"></i></a>
                  <a href="#" class="btn icon btn-danger"><i data-feather="trash"></i></a>
                </td>
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
        <form id="question-manage">
          <div class="modal-body">
            <input type="hidden" name="question_id" id="questionId">
            <div class="form-group">
              <label>Name</label>
              <input type="text" placeholder="User's name here..." id="question" name="question" class="form-control" required></textarea>
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
  </script>
@endsection
