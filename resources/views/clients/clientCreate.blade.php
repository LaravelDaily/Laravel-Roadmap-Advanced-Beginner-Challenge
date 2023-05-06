@extends('layouts.app')
@section('content')

    <div class="card uper" style="margin-left: 50px">
        <div class="card-header">
            Add project
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post"
                  action="{{ route('clients.store') }}"
                  enctype="multipart/form-data">

                <div class="form-group">
                    @csrf
                    <label for="name"> name</label>
                    <input type="text" class="form-control"
                           name="name" required/>
                </div>


                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" class="form-control"
                           name="email" id="email" required/>
                </div>


                <div class="form-group">
                    <label for="phoneNumber">phone Number</label>
                    <input type="text" class="form-control"
                           name="phoneNumber"  id="phoneNumber"/>

                </div>

                <div class="form-group">
                    <label for="VAT">VAT</label>
                    <input type="text" class="form-control"
                           name="VAT"  id="VAT"/>
                </div>

                <div class="form-group">
                    <label for="address">address</label>
                    <input type="text" class="form-control"
                           name="address"  id="address"/>
                </div>


                <button type="submit"
                        class="btn btn-primary" style="margin-top: 10px">save</button>
            </form>
        </div>
    </div>

@endsection
