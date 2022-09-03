@include('admin.head')
@include('admin.sidebar')

<div class="main-panel">
    <div class="content-wrapper ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product</h4>
                    </div>
                    <div class="card-header-right">
                        <a href="add-product">
                            <button type="button" class="btn btn-primary mr-4  float-right">
                                Add
                            </button>
                        </a>
                    </div>
                    <div class="card-body ">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>subcategory Name</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Discount</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <?php
                                    $fdata = \App\Models\Subcategory::where('id', $item->subcategory_id)->first();
                                    ?>
                                    <td>{{$fdata->name ?? ''}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->description}}</td>
                                    <td>{{ $item->discount}}</td>
                                    <td>
                                    <img style="width: 64px; height: 64px;" src="{{isset($item->image[0]->image) ? asset('/storage/image/'.$item->image[0]->image) : ''}}">
                                </td>
                                    <td>
                                        <a href="{{url('edit-product/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{url('delete-product/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>