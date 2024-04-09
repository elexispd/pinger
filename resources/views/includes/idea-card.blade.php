<div class="card my-3">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                        <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                        src="https://xsgames.co/randomusers/avatar.php?g=male" alt="Mario Avatar">
                    </div>

                    <div>
                        <h5 class="card-title mb-0">
                        <div>
                            <a href="{{ route('timeline', [$idea->user->username]) }}" class="text-capitalize"> {{ $idea->user->username }}
                            </a>
                        </div>

                        </h5>
                    </div>

                </div>
                @can('view', $idea)
                <div>
                    <a class="text-capitalize text-info edit" data-id="{{ $idea->id }}" data-content="{{ $idea->content }}"  data-bs-toggle="modal" data-bs-target="#editModal" > <i class="fa fa-edit"></i> </a>
                    <a class="text-capitalize text-danger mx-1 delete" data-id="{{ $idea->id }}"> <i class="fa fa-trash"></i> </a>

                </div>
                @endcan


        </div>
    </div>
    <div class="card-body">
        <p class="fs-6 fw-light text-muted">
            <a href=""style="text-decoration:none;" >{{ $idea->content }}</a>
        </p>
        <div class="row">
            <div class=" col-md-6 d-flex">
                <div class="mr-3">
                    <a style="text-decoration: none;" class="fw-light nav-link fs-6">
                        <span class="fas fa-heart like @if ($idea->likes->contains('user_id', Auth::id())) text-danger @endif"
                              onclick="like(event)" data-url="{{ route('like') }}" data-value='{{ $idea->id }}'>
                        </span> <span class="like-counter">{{ $idea->likes->count() }}</span>
                    </a>
                </div>

                <div class="px-2"> <!-- Added div container -->
                    <a href="{{ route('show_comment', $idea->id) }}" style="text-decoration: none;" class="fw-light nav-link fs-6">
                        <span class="fas fa-comment text-dark"></span>
                        <span class="comment-counter">{{ $idea->comments->count() }}</span>
                    </a>
                </div>

            </div>
            <div class="col-md-6 text-end">
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{ $idea->created_at->diffForHumans() }} </span>
            </div>
        </div>

    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="followModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="followModalLabel">Update Ping</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('idea.update') }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
              <label for="ping" class="form-label">Ping</label>
              <textarea name="content" id="ping" cols="78" class="form-control px-3" rows="10"></textarea>
              <input type="hidden" id="idea_id" name="idea_id">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this idea?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('idea.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="delete_idea_id" name="delete_idea_id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



  <script>
    $(".edit").click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var content = $(this).data('content');
        $("#ping").val(content);
        $("#idea_id").val(id);
    })




  </script>

  <script>
    $(".delete").click(function(e) {
        e.preventDefault();

        var ideaId = $(this).data('id');


    $('#delete_idea_id').val(ideaId);
    $('#deleteModal').modal('show');
    })
  </script>
