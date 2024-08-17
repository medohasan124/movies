  <!-- Modal -->
 <button class="btn btn-danger bulckDelete" disabled data-toggle="modal" data-target="#bulckDelete">
 <i class='fas fa-trash' ></i>
    @lang('admin.BulckDelete')
</button>
  <div class="modal fade" id="bulckDelete" tabindex="-1" role="dialog" aria-labelledby="bulckDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bulckDelete">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this role?
        </div>
        <div class="modal-footer">
          <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{ route('admin.role.bulckDelete') }}" method="POST">
            @csrf
            @method('post')
            <input type="hidden" class='buclkDeleteInput' name='buclkDelete[]'>
            <button type="submit" class="btn btn-danger bulckDeleteEnd" >Delete <i class='fas fa-trash'></i></button>
          </form>

        </div>
      </div>
    </div>
  </div>
