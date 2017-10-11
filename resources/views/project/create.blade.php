@extends('layouts.app')
@section('content')
    <div class="container" id="myapp">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <h3>Add Project</h3>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                                <div class="alert alert-danger msg" v-show="error">
                                    <ul v-for="e in errors">
                                            <li>@{{e}}</li>
                                    </ul>
                                </div>
                                <div class="alert alert-success msg" v-show="success">
                                        <span>@{{msg}}</span>
                                </div>
                            <div class="row">
                                <form  method="POST" class="col-md-10" id="project_form">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input type="text" name="project_name" class="form-control" v-model="project_name">
                                        <input type="hidden" name="project_id" class="form-control" v-model="project_id">
                                    </div>

                                    <div class="form-group">
                                        <label>Project Start Date</label>
                                        <input type="date" name="start_date" class="form-control" v-model="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label>Project End Date</label>
                                        <input type="date" name="end_date" class="form-control" v-model="end_date">
                                    </div>
                                    <div class="form-group">
                                        <input type="button" value="Add" class="form-control btn-primary" v-on:click="addProject()" v-show="project_id==0">
                                        <input type="button" value="Update" class="form-control btn-primary" v-on:click="updateProject()" v-show="project_id>0"><br>
                                        <input type="button" value="Cancel" class="form-control btn-primary" v-on:click="cancel()" v-show="project_id>0">
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h3>All Projects</h3>
                </div><br>
                <div class="alert alert-success msg" v-show="success2">
                    <span>@{{msg2}}</span>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="todo in projects">
                        <td>@{{todo.project_id}}</td>
                        <td>@{{todo.project_name}}</td>
                        <td>@{{todo.start_date}}</td>
                        <td>@{{todo.end_date}}</td>
                        <td>
                            <a class="fa fa-pencil-square-o" v-on:click="edit(todo.project_id)"></a>
                            <a class="fa fa-eraser" aria-hidden="true" v-on:click="remove(todo.project_id)"> </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
         </div>
    </div>
@endsection
@section('script')
<script>
    var d=new Vue({
        el:'#myapp',
        data:{
            projects:'',
            project_id:0,
            project_name:'',
            start_date:'',
            end_date:'',
            btn_text:'Add',
            error:false,
            success:false,
            msg:'',
            success2:false,
            msg2:'',
            errors:[]
        },
        created: function () {
            this.init();
        },
        methods:{
            cancel:function(){
                this.project_name = '';
                this.start_date = '';
                this.end_date = '';
                this.project_id=0;
            },
            addProject: function() {
                var $this=this;
                $.ajax({
                   url:base_url+'project/add',
                   method:"POST",
                   data:$('#project_form').serialize(),
                   success:function(e){
                       if(e.length>0) {
                           $this.success=false;
                           $this.error=true;
                           $this.errors=e;
                       }else{
                           $this.success=true;
                           $this.msg="Project Added Successfully"
                           $this.error=false;
                           $this.init();all()
                           $this.project_name = '';
                           $this.start_date = '';
                           $this.end_date = '';
                       }
                   }
                });
            },
            updateProject:function(){
                var $this=this;
                $.ajax({
                    url:base_url+'project/update',
                    method:"POST",
                    data:$('#project_form').serialize(),
                    success:function(e){
                        if(e.length>0) {
                            $this.error=true;
                            $this.errors=e;
                        }else{
                            $this.success=true;
                            $this.msg="Project Updated Successfully"
                            $this.error=false;
                            $this.init();
                            $this.project_name = '';
                            $this.start_date = '';
                            $this.end_date = '';
                        }
                    }
                });
            },
            remove:function(index)
            {
                let vm=this;
                $.getJSON(base_url+'project/delete/'+index, function (msg) {
                    vm.success2=true;
                    vm.msg2=msg.msg
                    vm.init();
                });
            },
            edit:function(index){
                this.project_id=index;
                this.projects.forEach(function(p){
                   if(p.project_id==index){
                       this.project_name= p.project_name;
                       this.start_date= p.start_date.split(' ')[0];
                       this.end_date= p.end_date.split(' ')[0];
                   }
                },this);
            },
            init:function(){
                $.getJSON(base_url+'project/view', function (data) {
                    this.projects=data;
                }.bind(this));
                setTimeout(function() {
                    $('.msg').fadeOut();
                }, 1000 );
            }
        }
    });
</script>
@endsection