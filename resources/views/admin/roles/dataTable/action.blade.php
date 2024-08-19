
<div>
    @permission("roles-update")
    <a href='{{ route('admin.roles.edit', $id) }}' class='btn btn-primary'>
        <i class='fas fa-edit'></i>
    </a>
    @endpermission
    @permission("roles-delete")
    <!-- Button trigger modal -->
<button  class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $id }}">
    <i class='fas fa-trash'></i>
  </button>
  @endpermission
  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this role?

        </div>
        <div class="modal-footer">
          <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{ route('admin.roles.destroy',$id) }} " method="post" >
            @csrf
            @method('DELETE')
            <button type="submit"  class="btn btn-danger"><i class='fas fa-trash' ></i></button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
