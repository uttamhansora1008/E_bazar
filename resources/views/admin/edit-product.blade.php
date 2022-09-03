@include('admin.head')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form action="{{ url('update-product/'.$product->id)}}" method="post" enctype="multipart/form-data">
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
                                <input type="text" name="name" value="{{$product->name}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Price</label>
                                <input type="text" name="price" value="{{$product->price}}" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Product Description</label>
                                <input type="text" name="description" value="{{$product->description}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Discount</label>
                                <input type="text" name="discount" value="{{$product->discount}}" class="form-control">
                            </div>
                           
                            <div class="form-group mb-3">
                                <label for="">Product Images</label>
                                <input type="file" name="image[]" multiple class=" @error('image') is-invalid @enderror form-control">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                          
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                            @if(count($product->image)>0)
                                @foreach($product->image as $item)
                               
                                    <a href="{{url('deleteimage/'.$item->id)}}"class="btn text-danger">X</a>
                                    @csrf
                                   
                                </form>
                                <img style="width: 200px; height: 200px;" src="{{ URL::asset('/storage/image/'.$item->image)}}">
                                @endforeach

                                @endif 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>