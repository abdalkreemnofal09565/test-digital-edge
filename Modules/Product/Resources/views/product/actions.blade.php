<div class="demo-inline-spacing justify-content-around" >

    <!-- show button --> 
    <a type="button" class="btn btn-sm btn-warning action-row mb-2" title="show" style="color:white;margin: 0px;" id="show_{{ $id }}" href="{{route('products.show',$id) }}">
        <i class="far fa-eye"></i>
    </a>

    @can('product.edit')
    <!-- edit button --> 
    <a type="button" class="btn btn-sm btn-info action-row mb-2" title="edit" style="margin: 0px;" id="edit_{{ $id }}" href="{{route('products.edit',$id) }}">
        <i class="far fa-edit "></i>
    </a>
    @endcan

    @can('product.delete')
    <!-- delete button --> 
    <button type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$id}}" class="btn btn-sm btn-danger action-row mb-2" title="delete" style="margin: 0px;">
        <i class="far fa-trash-alt "></i>
    </button>
    @endcan

</div>

@can('product.delete')
<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        </div>
        <div class="modal-body">
            are you sure to delete this record ?
        </div>
        <div class="modal-footer">
            <form id="delete-confirm-{{ $id }}" action="{{ route('products.destroy', $id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Confirm</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endcan