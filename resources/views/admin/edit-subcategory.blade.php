@include('admin.head')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit SubCategory</h4>
                        <form action="{{ url('update-subcategory/'.$subcategory->id)}}" method="post">
                            @csrf
                            <tr>
                                <td>
                                <label for="category">Select Category : <span class="bold red"></span></label></td>
                                <td>
                                    <select name="category" id="category" class="form-control" required>
                                        @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                     </select>

                                </td>
                            </tr>
                            <div class="form-group mb-3">
                            <label for="">SubCategory Name</label>
                            <input type="text" name="name" value="{{$subcategory->name}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">SubCategory status</label>
                            <input type="text" name="status" value="{{$subcategory->status}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>