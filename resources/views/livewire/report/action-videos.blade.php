
@if (Storage::disk()->exists("public/".$id.".mp4")) 
    <div class="flex space-x-1 justify-around">
        <a href="javascript:void(0)" onclick="show_videoModal('{{$id}}')" class="edit btn waves-effect waves-light btn-info">
            Edit
        </a> 
        <a href="javascript:void(0)" onclick="removedelete_video('{{$id}}')" class="edit btn waves-effect waves-light btn-danger">
            Delete
        </a> 
    </div>
@else
    <div class="flex space-x-1 justify-around">
        <a href="javascript:void(0)" onclick="show_videoModal('{{$id}}')" class="edit btn waves-effect waves-light btn-info">
            Add
        </a> 
    </div>
@endif