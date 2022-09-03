@include('admin.head')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <h4 class="card-title">Add Product</h4>
                        <form action="{{ url('add-prdouct')}}" method="post" enctype="multipart/form-data">   
                            @csrf
                            <tr>
                                <td>
                                    <label for="subcategory">Select Category : <span class="bold red"></span></label>
                                </td>
                                <td>
                                    <select name="subcategory" id="subcategory" class="form-control" required>
                                        @foreach($subcategory as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <div class="form-group mb-3">
                                <label for="">Prouct Name</label>
                                <input type="text" name="name" class=" @error('name') is-invalid @enderror form-control">
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Price</label>
                                <input type="text" name="price" class=" @error('price') is-invalid @enderror form-control">
                                @error('price')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Description</label>
                                <input type="text" name="description" class=" @error('description') is-invalid @enderror form-control">
                                @error('description')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Discount</label>
                                <input type="text" name="discount" class=" @error('discount') is-invalid @enderror form-control">
                                @error('discount')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Images</label>
                                <input type="file" name="image[]" multiple class=" @error('image') is-invalid @enderror form-control">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>










