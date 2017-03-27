@extends('admin.layouts.app')
@section('content')

        <div class="container">
        <div class="row">
                <div class="col-sm-8 col-sm-offset-1">
                    <div class="login-form">
                        <div class="step-one">
                    <h2 class="heading">Add Product</h2>
                            </div>
                        <form  role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                           
                                <input id="name" type="name"  name="name" value="{{ old('name') }}" placeholder = "Product Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('brand') ? ' has-error' : '' }}">
                            
                                <input id="text" type="text"  name="brand" placeholder = "Brand or manufacturer" required>

                                @if ($errors->has('brand'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </span>
                                @endif

                        </div>


                        <div class="{{ $errors->has('category') ? ' has-error' : '' }}">
                            
                                <select name="category">
                                    <option disabled selected>Select Product Category</option>
                                    <option value="Hair">Hair</option>
                                    <option value="Face">Face</option>
                                    <option value="Body">Body</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Nails">Nails</option>
                                    <option value="Perfume">Perfume</option>
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div style="margin-top:2%; margin-bottom:2%;"  class="{{ $errors->has('description') ? ' has-error' : '' }}">
                            
                                <textarea name="description" placeholder = "Describe the product"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="{{ $errors->has('price') ? ' has-error' : '' }}">
                            
                                <input id="price" type="price"  name="price" placeholder = "Unit Price" required>

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="{{ $errors->has('total') ? ' has-error' : '' }}">
                            
                                <input id="text" type="text"  name="total" placeholder = "Quantity in stock" required>

                                @if ($errors->has('total'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif

                        </div>

                       <div class="{{ $errors->has('image') ? ' has-error' : '' }}">
                           <input type="file" name="image">
                              @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                       </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    Submit
                                </button>

                                
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
              
            </div>
        </div>

@endsection
