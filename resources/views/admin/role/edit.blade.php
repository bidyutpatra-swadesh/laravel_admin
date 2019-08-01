@extends('admin.layouts.fancybox')
@section('content')
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header">Edit Role</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">Role</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong>{{Session::get('success')}}</strong>
                        </div>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('admin::updateRole')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$roleById->id}}"/>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{$roleById->name}}" placeholder="Enter Brand Title" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Display Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="display_name" value="{{$roleById->display_name}}" placeholder="Enter Display Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea style="margin: 0px; width: 721px; height: 54px;" name="description">{!! $roleById->description !!}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-form-label">
                                    <i class="fa fa-key"></i> <b>Select All Permission :</b>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="allSelect" name="select_all">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">

                                </div>
                            </div>
                            @foreach($permissions as $permissionGroup=>$permission)
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-form-label">
                                        <i class="fa fa-key"></i> <b>{{$permissionGroup}} :</b>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="row">
                                            @foreach($permissions[$permissionGroup] as $per)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input permissions" id="permissions" name="permissions[]"  value="{{$per['id']}}" @if($per['count'] > 0) checked @endif>
                                                        <label class="form-check-label">{{ucwords($per['display_name'])}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-6">

                                    </div>
                                </div>

                            @endforeach

                            <div class="form-group">
                                <div class="col-md-12" style="text-align: center">
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            // add multiple select / deselect functionality

            $("#allSelect").click(function () {
                $('.permissions').attr('checked', this.checked);
            });

            // if all checkbox are selected, check the selectall checkbox
            // and viceversa
            $(".permissions").click(function(){
                if($(".permissions").length == $(".permissions:checked").length) {
                    $("#allSelect").attr("checked", "checked");
                } else {
                    $("#allSelect").removeAttr("checked");
                }
            });
        </script>
    @endpush
@endsection