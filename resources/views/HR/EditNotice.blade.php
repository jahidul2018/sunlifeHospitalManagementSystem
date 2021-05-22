@extends('Layouts.App')
@section('content')
<style>
    .filePreview{
        height: 100vh;
        width: 100%;
        border-radius: 5px solid green;
    }
</style>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
        <div class="card-header py-3">  
        <center class="text-primary font-weight-bold ">
            Edit <strong><u><i>{{ $title }}</i></u></strong> Notice
        </center>
    </div>


    <div class="container">
        <form method="POST">
            {{csrf_field()}}
            <table width="100%">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" class="form-control" value="{{ $title }}" name="title">
                    </td>
                </tr>

                <tr>
                    <td>Notice Body</td>
                    <td>
                        <textarea class="form-control" name="body" >  
                            {{ $body }}  
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Tag Pepoles</td>
                    <td>
                        <select class="form-control" name="tagPeople">
                        <option selected>{{ $tagPeople }}</option>
                        <option>All</option>
                        <option>HR Dept</option>
                        <option>Doctors</option>
                        <option>Managers</option>
                        <option>Reciptionists</option>
                        </select>
                    </td>
                </tr>
    
                <tr>
                    <td>Additional File</td>
                    <td>
                        <input type="hidden" name="currentAdditonalFile" value="{{ $additionalFile }}">
                        <input type="file"   name="addtionalFile">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="btn btn-primary" value="Update Notice">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Additional File Preview -->

    <div class="container">
            @if($additionalFile != null)
                <div class="col-sm-12">
                    <div class="container">
                        <div class="container bg card">
                            <center>
                                <h5>Additional File's</h5>
                            </center>
                            <iframe src="{{url('noticeFile/'.$additionalFile)}}" class="frame filePreview" frameborder="0" height="100vh"></iframe>
                        </div>
                    </div>
                </div>
            @endif
    </div>
@endsection