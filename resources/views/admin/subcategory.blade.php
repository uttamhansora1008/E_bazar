@include('admin.head')
@include('admin.sidebar')

<div class="main-panel">
    <div class="content-wrapper ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header">
                    <h4>Sub Category</h4>
                </div>
                
                <div class="card-header-right" >
                <a href="add-subcategory">
                    <button type="button" class="btn btn-primary mr-2 float-right" >
                        Add
                    </button>

                </a>
            </div>
                    <div class="card-body ">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Category Name</th>
                                <th>Subcategory Name</th>
                                <th>status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <?php

                                $fdata=\App\Models\Category::where('id',$item->category_id)->first();

                                ?>
                                <td>{{$fdata->name ?? ''}}</td>

                                 <td>{{ $item->name }}</td>
                                 <td>{{ $item->status }}</td>

                                <td>
                                    <a href="{{url('edit-subcategory/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    <a href="{{url('delete-subcategory/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
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