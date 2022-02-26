<!-- Modal Delete -->
<div class="modal fade modal-delete" id="modal-delete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure want to delete <b class="nickname"></b> from <span
                        class="model"></span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-transparent" data-dismiss="modal">Cancel</button>
                <form class="d-inline-block" action="#" method="post">
                    @csrf
                    @method('delete')
                    {{-- <input type="hidden" name="_method" value="DELETE" /> --}}
                    <button type="submit" href="#" class="btn btn-danger btn-delete-modal"><i
                            class="far fa-fw fa-trash-alt"></i>
                        Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
