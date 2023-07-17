@extends('dashboards.admin.admin_master')
@section('dashboards.admin.content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row-fluid sortable">
<div class="box span12">
    <div class="box-header" data-original-title>
        <p class="alert-success">
            <?php
              
            $message = Session::get('message');
            if($message)
            {
                echo $message;
                Session::put('message',null);
            }
            ?>
        </p>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Product</h2>

    </div>

    <div class="box-content">
        <form class="form-horizontal" action="{{ url('/productupdate'.$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="date01">Product Code</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="code" value="{{ $product->code }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Product Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="name" value="{{ $product->name }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Select Category</label>
                    <div class="control">
                        <select name="category" style="margin-left: 20px;">
                            <option>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Select SubCategory</label>
                    <div class="control">
                        <select name="subcategory" style="margin-left: 20px;">
                            <option>Select SubCategory</option>
                            @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Select Brand</label>
                    <div class="control">
                        <select name="brand" style="margin-left: 20px;">
                            <option>Select Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Product Description</label>
                    <div class="controls">
                        <textarea class="cleditor" name="description" rows="3" required>{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="date01">Product Price</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="price" value="{{ $product->price }}" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">File Upload</label>
                    <div class="controls">
                        <input type="file" name="file[]" multiple required>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Edit </button>
                </div>
            </fieldset>
        </form>

    </div>
</div><!--/span-->
</div><!--/row-->
</div><!--/row-->

@endsection 