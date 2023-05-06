@extends('layouts.app');
@section('content')


    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <td>id </td>
                <td>company</td>
                <td>VAT</td>
                <td>address</td>


                {{--                <td colspan="3">Action</td>--}}
                <td>Action</td>
            </tr>
            </thead>
            <tbody>

            @foreach($clients as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{$client->name  }}</td>
                    <td>{{$client->VAT}}</td>
                    <td>{{$client->address}}</td>



{{--                    <td>--}}
{{--                        <form action="/clients/details/{{ $client->id }}"--}}
{{--                              method="post">--}}
{{--                            @csrf--}}
{{--                            <button class="btn btn-primary" type="submit">Details</button>--}}
{{--                        </form>--}}
{{--                    </td>--}}
                    <td>
                        <form action="/clients/{{ $client->id }}/delete"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>


                    <td>

                        <a class="btn btn-success"  href="{{route('clients.edit',$client->id)}}">edit</a>

                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <a href="/clients/create" class="btn btn-success"> create client </a>
    </div>




@endsection
