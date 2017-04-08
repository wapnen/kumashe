@extends('layouts.app')
@section('content')
 <div class="container">
        <div class="row">
                <div class="col-sm-8 col-sm-offset-1">
                    <div class="login-form">
                        <div class="step-one">
                    <h2 class="heading">Edit Profile</h2>
                            </div>
                        <form  role="form" method="POST" action="/edit_user" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                           
                                <input id="name" type="name"  name="name" value="{{ Auth::user()->name }}" placeholder = "Name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('phone') ? ' has-error' : '' }}">
                            
                                <input id="text" type="text"  name="phone" placeholder = "phone" value="{{ Auth::user()->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="{{ $errors->has('address') ? ' has-error' : '' }}">
                           
                                <input id="address" type="address"  name="address" value="{{ $address->address }}" placeholder = "Address" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('landmark') ? ' has-error' : '' }}">
                            
                                <input id="text" type="text"  name="landmark" placeholder = "Opposite, Close to.." value="{{$address->landmark}}" required>

                                @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
                                    </span>
                                @endif

                        </div>
                        	<input type="hidden" value="{{$address->id}}" name="address_id">
                        <div class="{{ $errors->has('LGA') ? ' has-error' : '' }}">
                            
                                <select name="LGA">
                                    <option disabled selected value="{{$address->LGA}}">{{$address->LGA}}</option>
                                    <option value="Barkin Ladi">Barkin Ladi</option>
                                    <option value="Bassa">Bassa</option>
                                    <option value="Bokkos">Bokkos</option>
                                    <option value="Jos-East">Jos-East</option>
                                    <option value="Jos-North">Jos-North</option>
                                    <option value="Jos-South">Jos-South</option>
                                    <option value="Kanam">Kanam</option>
                                    <option value="Kanke">Kanke</option>
                                    <option value="Langtang-North">Langtang-North</option>
                                    <option value="Langtang-South">Langtang-South</option>
                                    <option value="Mangu">Mangu</option>
                                    <option value="Mikang">Mikang</option>
                                    <option value="Qua'anpan">Qua'an Pan</option>
                                    <option value="Ryom">Ryom</option>
                                    <option value="Shendam">Shendam</option>
                                    <option value="Wasse">Wasse</option>
                                </select>
                                @if ($errors->has('landmark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landmark') }}</strong>
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