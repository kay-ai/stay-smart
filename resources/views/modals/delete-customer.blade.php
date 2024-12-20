<!-- Modal -->
<div class="modal fade" id="delete_customer" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: flex;">
                <h5 id="modal_title" class="modal-title">Delete Customer</h5>
                <div class="ml-auto">
                    <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>

            </div>
            <div class="modal-body" id="view_card_body">
                Are you sure you want to delete this Customer?
            </div>
            <form method="post" id="customer_delete_form">
                @csrf
                <div class="p-3 d-flex justify-content-end gap-3">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
