<form action="" method="GET">
    @if(!isset($withoutUserFilter) || $withoutUserFilter === false)
        <div class="d-inline-block my-1">User:</div>
        <label class="btn btn-sm my-1 @if(!request('assigned_to_user')) btn-primary @else btn-secondary @endif">
            <input class="d-none" name="assigned_to_user" type="radio" value="0"
                   @if(request('assigned_to_user') == 0) checked @endif onchange="this.form.submit();">
            All
        </label>
        <label class="btn btn-sm my-1 @if(request('assigned_to_user') == 1) btn-primary @else btn-secondary @endif">
            <input class="d-none" name="assigned_to_user" type="radio" value="1"
                   @if(request('assigned_to_user') == 1) checked @endif onchange="this.form.submit();">
            Assigned to me
        </label>
    @endif
    <div class="d-inline-block my-1">Status:</div>
    <label class="btn btn-sm my-1 @if(!request('status_id')) btn-primary @else btn-secondary @endif">
        <input class="d-none" name="status_id" type="radio" value="0" @if(request('status_id') == 0) checked @endif
        onchange="this.form.submit();">
        All
    </label>
    @foreach($modelStatuses as $id => $status)
        <label class="btn btn-sm my-1 @if(request('status_id') == $id) btn-primary @else btn-secondary @endif">
            <input class="d-none" name="status_id" type="radio" value="{{ $id }}"
                   @if(request('status_id') == $id) checked @endif onchange="this.form.submit();">
            {{ $status }}
        </label>
    @endforeach
</form>
