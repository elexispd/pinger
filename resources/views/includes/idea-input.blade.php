

<div class="row">
    <form action="{{ route('postIdea') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" name="content" id="idea" rows="3"></textarea>
        </div>
        <div class="">
            <button name="submit" type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>

